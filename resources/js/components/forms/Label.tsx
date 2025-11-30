// resources/js/components/ui/Label.tsx
import { ReactNode } from 'react';
import { twMerge } from 'tailwind-merge';

interface LabelProps {
  value?: string;
  children?: ReactNode;
  className?: string;
  htmlFor?: string; // important for accessibility
  [key: string]: any; // allows any other HTML attributes
}

export default function Label({
  value,
  children,
  className = '',
  htmlFor,
  ...props
}: LabelProps) {
  const content = value ?? children;

  return (
    <label
      htmlFor={htmlFor}
      className={twMerge('block font-medium', className)}
      {...props}
    >
      {content}
    </label>
  );
}
