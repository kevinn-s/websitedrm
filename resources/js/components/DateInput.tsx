// Source - https://stackoverflow.com/a/76262810
// Posted by Ivan Tikhonov
// Retrieved 2025-12-24, License - CC BY-SA 4.0

import * as React from "react";

import {
    Control,
    Path,
    useController
} from "react-hook-form";

import { DatePicker, LocalizationProvider } from "@mui/x-date-pickers";
import { AdapterDateFns } from "@mui/x-date-pickers/AdapterDateFns";
import { IPublication } from "@/types/publication";

type PublicationDateField = Extract<Path<IPublication>, "date">;

interface IProps {
    label: string;
    name?: PublicationDateField;
    control: Control<IPublication>;
}

export const DateInput = ({ label, name = "date", control }: IProps) => {
    const { field } = useController({ control, name, defaultValue: null });

    return (
        <LocalizationProvider dateAdapter={AdapterDateFns}>
            <DatePicker
                className="rounded-full"
                label={label}
                maxDate={new Date()}
                value={field.value}
                onChange={field.onChange}
                slotProps={{
                    textField: {
                        ...{ readOnly: true },
                        InputProps: { className: "h-10 rounded-none text-sm" },
                        InputLabelProps: { className: "text-sm" },
                        className: "rounded-full w-full"
                    }
                }}
            />
        </LocalizationProvider>
    );
};
