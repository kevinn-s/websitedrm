import React, { ButtonHTMLAttributes, ReactElement } from 'react';
import { twMerge } from 'tailwind-merge';

type ButtonVariant = 'primary' | 'primary-reverse' | 'secondary' | 'outline';
type ButtonSize = 'sm' | 'md' | 'lg';

interface ButtonProps
    extends React.DetailedHTMLProps<
        React.ButtonHTMLAttributes<HTMLButtonElement>,
        HTMLButtonElement
    > {
    type?: "button" | "submit" | "reset";
    size?: ButtonSize;
    variant?: ButtonVariant;
    onSelect?: () => any;
    isLoading?: boolean;
    /** whether button is in active state */
    selected?: boolean;
    children: React.ReactNode;
    className?: string;
}

const SIZE_CLASSES: Record<ButtonSize, string> = {
  sm: 'px-2 py-2 text-sm',
  md: 'px-5 py-2.5 text-base',
  lg: 'px-10 py-5 text-lg',
};

const VARIANT_CLASSES: Record<ButtonVariant, string> = {
  primary:
    'bg-primary-green-500 text-white border-b-4 border-b-primary-green-800 hover:bg-primary-green-600',
  'primary-reverse':
    'bg-white text-[#02743D] border-2 border-primary-green hover:bg-[#02743D] hover:text-white hover:border-primary-green',
  secondary:
    'bg-gray-600 text-white border-2 border-gray-600 hover:bg-gray-700 hover:border-gray-700 border-b-transparent',
  outline:
    'bg-white text-[#02743D] border-2 border-primary-green hover:bg-[#02743D] hover:text-white hover:border-primary-green border-b-transparent',
};

export default function Button({
    variant = 'primary',
    size = 'sm',
    children,
    className = '',
    disabled,
    type,
    isLoading,
    onSelect,
    ...props
}: ButtonProps) {
    return (
        <button
            onClick={onSelect ? (e) => onSelect() : undefined}
            type={type}
            className={twMerge('inline-flex items-center justify-center font-semibold tracking-tight transition-all duration-300 ease-in-out font-noto', VARIANT_CLASSES[variant], SIZE_CLASSES[size], disabled ? 'opacity-60 bg-gray-200 text-gray-900 cursor-not-allowed' : '', className)}
            disabled={disabled}
            {...props}
        >
            {children}
        </button>
    )
}
