<?php

namespace Myth\Auth\Language\en;

return [
    // Exceptions
    'invalidModel' => 'The {0} model must be loaded prior to use.',
    'userNotFound' => 'Unable to locate a user with ID = {0, number}.',
    'noUserEntity' => 'User Entity must be provided for password validation.',
    'tooManyCredentials' => 'You may only validate against 1 credential other than a password.',
    'invalidFields' => 'The "{0}" field cannot be used to validate credentials.',
    'unsetPasswordLength' => 'You must set the `minimumPasswordLength` setting in the Auth config file.',
    'unknownError' => 'Sorry, we encountered an issue sending the email to you. Please try again later.',
    'notLoggedIn' => 'You must be logged in to access that page.',
    'notEnoughPrivilege' => 'You do not have sufficient permissions to access that page.',

    // Registration
    'registerDisabled' => 'Sorry, new user accounts are not allowed at this time.',
    'registerSuccess' => 'Selamat datang! Silakan masuk menggunakan kredensial baru Anda.',
    'registerCLI' => 'New user created: {0}, #{1}',

    // Activation
    'activationNoUser' => 'Unable to locate a user with that activation code.',
    'activationSubject' => 'Activate your account',
    'activationSuccess' => 'Please confirm your account by clicking the activation link in the email we have sent.',
    'activationResend' => 'Resend activation message one more time.',
    'notActivated' => 'This user account is not yet activated.',
    'errorSendingActivation' => 'Failed to send activation message to: {0}',

    // Login
    'badAttempt' => 'Gagal masuk. Silakan periksa kredensial Anda.',
    'loginSuccess' => 'Selamat datang kembali!',
    'invalidPassword' => 'Gagal masuk. Silakan periksa kata sandi Anda.',

    // Forgotten Passwords
    'forgotDisabled' => 'Reseting password option has been disabled.',
    'forgotNoUser' => 'Unable to locate a user with that email.',
    'forgotSubject' => 'Password Reset Instructions',
    'resetSuccess' => 'Your password has been successfully changed. Please login with the new password.',
    'forgotEmailSent' => 'A security token has been emailed to you. Enter it in the box below to continue.',
    'errorEmailSent' => 'Unable to send email with password reset instructions to: {0}',
    'errorResetting' => 'Unable to send reset instructions to {0}',

    // Passwords
    'errorPasswordLength' => 'Kata sandi harus memiliki panjang minimal {0} karakter.',
    'suggestPasswordLength' => 'Frasa sandi - hingga 255 karakter - membuat kata sandi lebih aman dan mudah diingat.',
    'errorPasswordCommon' => 'Kata sandi tidak boleh merupakan kata sandi umum.',
    'suggestPasswordCommon' => 'Kata sandi diperiksa terhadap lebih dari 65 ribu kata sandi umum atau yang bocor dari peretasan.',
    'errorPasswordPersonal' => 'Kata sandi tidak boleh mengandung informasi pribadi.',
    'suggestPasswordPersonal' => 'Variasi dari alamat email atau nama pengguna Anda sebaiknya tidak digunakan sebagai kata sandi.',
    'errorPasswordTooSimilar' => 'Kata sandi terlalu mirip dengan nama pengguna.',
    'suggestPasswordTooSimilar' => 'Jangan gunakan bagian dari nama pengguna Anda dalam kata sandi.',
    'errorPasswordPwned' => 'Kata sandi {0} telah bocor karena pelanggaran data dan telah ditemukan sebanyak {1} kali dalam {2} database yang diretas.',
    'suggestPasswordPwned' => '{0} sebaiknya tidak digunakan sebagai kata sandi. Jika Anda menggunakannya di tempat lain, segera ubah.',
    'errorPasswordPwnedDatabase' => 'sebuah database',
    'errorPasswordPwnedDatabases' => 'banyak database',
    'errorPasswordEmpty' => 'Kata sandi wajib diisi.',
    'passwordChangeSuccess' => 'Kata sandi berhasil diubah',
    'userDoesNotExist' => 'Kata sandi tidak diubah. Pengguna tidak ditemukan',
    'resetTokenExpired' => 'Maaf. Token reset Anda telah kedaluwarsa.',

    // Groups
    'groupNotFound' => 'Unable to locate group: {0}.',

    // Permissions
    'permissionNotFound' => 'Unable to locate permission: {0}',

    // Banned
    'userIsBanned' => 'User has been banned. Contact the administrator',

    // Too many requests
    'tooManyRequests' => 'Terlalu banyak permintaan. Harap tunggu {0} detik.',

    // Login views
    'home' => 'Home',
    'current' => 'Current',
    'forgotPassword' => 'Forgot Your Password?',
    'enterEmailForInstructions' => 'No problem! Enter your email below and we will send instructions to reset your password.',
    'email' => 'Email',
    'emailAddress' => 'Email Address',
    'sendInstructions' => 'Send Instructions',
    'loginTitle' => 'Login',
    'loginAction' => 'Login',
    'rememberMe' => 'Remember me',
    'needAnAccount' => 'Need an account?',
    'forgotYourPassword' => 'Forgot your password?',
    'password' => 'Password',
    'repeatPassword' => 'Repeat Password',
    'emailOrUsername' => 'Email or username',
    'username' => 'Username',
    'register' => 'Register',
    'signIn' => 'Sign In',
    'alreadyRegistered' => 'Already registered?',
    'weNeverShare' => 'We\'ll never share your email with anyone else.',
    'resetYourPassword' => 'Reset Your Password',
    'enterCodeEmailPassword' => 'Enter the code you received via email, your email address, and your new password.',
    'token' => 'Token',
    'newPassword' => 'New Password',
    'newPasswordRepeat' => 'Repeat New Password',
    'resetPassword' => 'Reset Password',
];
