export default function Inset ({ children, className = '' })  {
  return (
    <div
      className={`border-l-5 border-[#b1b4b6] pl-4 py-2 my-2 ${className}`}
    >
      {children}
    </div>
  );
};
