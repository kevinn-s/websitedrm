import React, { ReactNode } from 'react'

export default function Chip({ children } : { children : ReactNode }) {
  return (
    <div className="rounded-md bg-slate-800 py-0.5 px-2.5 border border-transparent text-sm text-white transition-all shadow-sm">
        {children}
    </div>
  )
}
