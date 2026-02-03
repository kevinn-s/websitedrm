import React from "react"

interface InputProps extends React.InputHTMLAttributes<HTMLInputElement> {
    className?: string
}

export const Input = React.forwardRef<HTMLInputElement, InputProps>(
    ({ className = "", ...props }, ref) => {
        return (
            <input
                ref={ref}
                className={`border-gray-300 border focus:border-indigo-500 focus:ring-indigo-500 ${className}`}
                {...props}
            />
        )
    }
)

Input.displayName = "Input"
