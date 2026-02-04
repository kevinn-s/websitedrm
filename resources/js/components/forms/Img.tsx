import React, { useEffect, useRef, useState } from 'react';
import { UseFormRegisterReturn } from 'react-hook-form';
import Button from '../Button';
import Cropper, { ReactCropperElement } from "react-cropper";
import "cropperjs/dist/cropper.css";

export function Image({ defaultImage, register, setImageValue }: {
    defaultImage: string,
    register: UseFormRegisterReturn,
    setImageValue: (file: File | null) => void
}) {
    const inputRef = useRef<HTMLInputElement>(null);
    const cropperRef = useRef<ReactCropperElement>(null);

    const [image, setImage] = useState<string | null>(defaultImage);
    const [previewUrl, setPreviewUrl] = useState<string>(defaultImage);
    const [onImageEdit, setOnImageEdit] = useState<boolean>(false);

    const previousCropBoxRef = useRef<any>(null);

    const onCrop = (e: React.MouseEvent) => {
        e.preventDefault();
        const cropper = cropperRef.current?.cropper;
        if (!cropper) return;

        const canvas = cropper.getCroppedCanvas();

        canvas.toBlob((blob) => {
            if (blob) {
                const file = new File([blob], "avatar.jpg", { type: "image/jpeg" });

                setImageValue(file);

                setPreviewUrl(URL.createObjectURL(blob));
                setOnImageEdit(false);
            }
        }, 'image/jpeg', 0.8);
    };

    const handleFileChange = (e: React.ChangeEvent<HTMLInputElement>) => {
        const file = e.target.files?.[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = () => {
                setImage(reader.result as string);
                setOnImageEdit(true);
            };
            reader.readAsDataURL(file);
        }
    };

    return (
        <>
            {/* We still use register, but we'll override the onChange */}
            <input
                {...register}
                type="file"
                ref={inputRef}
                hidden
                onChange={handleFileChange}
                accept="image/*"
            />

            <div className="w-20 relative">
                <div
                    className="h-20 rounded-full overflow-hidden cursor-pointer bg-gray-200"
                    onClick={() => inputRef.current?.click()}
                >
                    <img className="w-full h-full object-cover" src={previewUrl} alt="Preview" />
                </div>
                <button type='button' className='absolute right-0 bottom-0' onClick={(e) => {
                            e.preventDefault();
                            setOnImageEdit((onImageEdit) => !onImageEdit);
                        }}>
                            <div className='w-4 h-4'>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14"><path fill="#000000" fillRule="evenodd" d="M1.8 0A1.8 1.8 0 0 0 0 1.8v10.4A1.8 1.8 0 0 0 1.8 14h3.714a1.25 1.25 0 0 1-.092-.674l.112-.795H1.975a.506.506 0 0 1-.506-.506V7.004a11.355 11.355 0 0 1 5.502 1.25c.194.141.462.343.758.575l3.046-3.052a1.25 1.25 0 0 1 1.769 0L14 7.231V1.8A1.8 1.8 0 0 0 12.2 0zm8.669 3.59a1.5 1.5 0 1 1-1.5-1.5h.045c.803 0 1.455.651 1.455 1.455zm-3.672 8.94l-.137.969l2.13-.29L13.5 8.5l-1.84-1.84l-4.7 4.71l-.163 1.161Z" clipRule="evenodd" /></svg>
                            </div>
                        </button>
            </div>

            {onImageEdit && image && (
                <div className='fixed inset-0 z-50 flex items-center justify-center bg-black/50'>
                    <div className="bg-white p-4 rounded-lg">
                        <Cropper
                            src={image}
                            style={{ height: 400, width: 400 }}
                            ready={() => {
                            cropperRef.current?.cropper.setCropBoxData(previousCropBoxRef.current);
                        }}
                            initialAspectRatio={1}
                            ref={cropperRef}
                            viewMode={1}
                            background={false}
                            responsive={true}
                            autoCropArea={1}
                        />
                        <div className="flex gap-2 mt-4">
                            <Button type='button' onClick={onCrop}>Save Crop</Button>
                            <Button type='button' onClick={() => setOnImageEdit(false)}>Cancel</Button>
                        </div>
                    </div>
                </div>
            )}
        </>
    );
}
