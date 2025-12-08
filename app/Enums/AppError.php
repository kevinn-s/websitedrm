<?php

namespace App\Enums;

enum AppError: string
{
    // =============== LOGIN ===============
    case INVALID_CREDENTIALS = 'INVALID_CREDENTIALS';
    case USER_NOT_VERIFIED = 'USER_NOT_VERIFIED';
    case UNAUTHORIZED_ACCESS = 'UNAUTHORIZED_ACCESS';

    // =============== REGISTRATION ===============
    case EMAIL_ALREADY_REGISTERED = 'EMAIL_ALREADY_REGISTERED';

    // =============== FORGOT PASSWORD ===============
    case INVALID_USER = 'INVALID_USER';                // ↔ PasswordBroker::INVALID_USER
    case EMAIL_SEND_FAILED = 'EMAIL_SEND_FAILED';

    // =============== RESET PASSWORD ===============
    case INVALID_TOKEN = 'INVALID_TOKEN';              // ↔ PasswordBroker::INVALID_TOKEN
    case EXPIRED_TOKEN = 'EXPIRED_TOKEN';              // opsional, jika ingin bedakan
    case RESET_THROTTLED = 'RESET_THROTTLED';          // ↔ PasswordBroker::RESET_THROTTLED
    case RESET_ATTEMPTS_EXCEEDED = 'RESET_ATTEMPTS_EXCEEDED'; // alternatif human-readable
    case PASSWORD_VALIDATION_FAILED = 'PASSWORD_VALIDATION_FAILED';
    case RESET_PASSWORD_FAILED = 'RESET_PASSWORD_FAILED';

     // =============== JWT / TOKEN ERRORS ===============
    case AUTH_TOKEN_EXPIRED = 'TOKEN_EXPIRED';
    case AUTH_TOKEN_INVALID = 'TOKEN_INVALID';
    case AUTH_TOKEN_BLACKLISTED = 'TOKEN_BLACKLISTED';

    // =============== ERROR UMUM ===============
    case VALIDATION_EXCEPTION = 'VALIDATION_EXCEPTION';
    case UNKNOWN_ERROR = 'UNKNOWN_ERROR';
    case INTERNAL_SERVER_ERROR = 'INTERNAL_SERVER_ERROR';
    case DATABASE_OPERATION_FAILED = 'DATABASE_OPERATION_FAILED';
}
