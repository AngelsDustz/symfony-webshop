<?php


namespace App\Security\Admin;

use App\DTO\AdminDTO;
use App\Entity\Admin;
use App\Entity\User;
use App\Form\Type\AdminLoginType;
use App\Repository\AdminRepository;
use Doctrine\ORM\EntityManagerInterface;

use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Psr\Log\LoggerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\Forms;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Exception\InvalidCsrfTokenException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Guard\PasswordAuthenticatedInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

/**
 * Class LoginFormAuthenticator.
 */
class LoginFormAuthenticator extends AbstractFormLoginAuthenticator implements PasswordAuthenticatedInterface
{
    use TargetPathTrait;

    private const LOGIN_ROUTE = 'admin_login';

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var UrlGeneratorInterface
     */
    private $urlGenerator;

    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * LoginFormAuthenticator constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param UrlGeneratorInterface $urlGenerator
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(EntityManagerInterface $entityManager, UrlGeneratorInterface $urlGenerator, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->entityManager = $entityManager;
        $this->urlGenerator = $urlGenerator;
        $this->passwordEncoder = $passwordEncoder;
        $this->formFactory = Forms::createFormFactory();
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function supports(Request $request): bool
    {
        return self::LOGIN_ROUTE === $request->attributes->get('_route')
            && $request->isMethod('POST');
    }

    /**
     * @param Request $request
     *
     * @return AdminDTO
     */
    public function getCredentials(Request $request): AdminDTO
    {
        $form = $this->formFactory->create(AdminLoginType::class, new AdminDTO());
        $form->submit($request->get('admin_login'));

        if ($form->isValid() === false) {
            throw new CustomUserMessageAuthenticationException('error.authenticate.generic');
        }

        /** @var AdminDTO $adminDTO */
        $adminDTO = $form->getData();

        $request->getSession()->set(
            Security::LAST_USERNAME,
            $adminDTO->username
        );

        return $adminDTO;

    }

    /**
     * @param mixed $credentials
     * @param UserProviderInterface $userProvider
     *
     * @throws NonUniqueResultException
     *
     * @return Admin
     */
    public function getUser($credentials, UserProviderInterface $userProvider): Admin
    {
        if (!$credentials instanceof AdminDTO) {
            throw new CustomUserMessageAuthenticationException('error.authenticate.generic');
        }

        /** @var AdminRepository $adminRepository */
        $adminRepository = $this->entityManager->getRepository(Admin::class);

        try {
            $user = $adminRepository->findOneByUsername($credentials->username);
        } catch (NoResultException $exception) {
            throw new CustomUserMessageAuthenticationException('error.authenticate.badLogin');
        }

        return $user;
    }

    /**
     * @param mixed $credentials
     * @param UserInterface $user
     *
     * @return bool
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        if (!$credentials instanceof AdminDTO) {
            throw new \RuntimeException(sprintf('Expected credentials to be of type %s, got %s', AdminDTO::class, get_class($credentials)));
        }

        return $this->passwordEncoder->isPasswordValid($user, $credentials->password);
    }

    /**
     * @param Request $request
     * @param TokenInterface $token
     * @param string $providerKey
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey): Response
    {
        if ($targetPath = $this->getTargetPath($request->getSession(), $providerKey)) {
            return new RedirectResponse($targetPath);
        }

        return new RedirectResponse($this->urlGenerator->generate('admin_dashboard'));
    }

    /**
     * @return string
     */
    protected function getLoginUrl(): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }

    /**
     * @param mixed $credentials
     *
     * @return string|null
     */
    public function getPassword($credentials): ?string
    {
        if (!$credentials instanceof AdminDTO) {
            throw new \RuntimeException(sprintf('Expected credentials to be of type %s, got %s', AdminDTO::class, get_class($credentials)));
        }

        return $credentials->password;
    }
}

