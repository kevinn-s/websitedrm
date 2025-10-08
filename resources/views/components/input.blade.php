<div>
                @php
                    // We need this extra step to support models arrays. Ex: wire:model="emails.0"  , wire:model="emails.1"
                    $uuid = $uuid . $modelName()
                @endphp

                <fieldset class="fieldset py-0">
                    {{-- STANDARD LABEL --}}
                    @if($label && !$inline)
                        <legend class="fieldset-legend mb-0.5">
                               @if($attributes->get('required'))
                                <span class="text-red-600">*</span>
                            @endif
                            {{ $label }}

                         
                        </legend>
                    @endif

                    <label @class(["floating-label" => $label && $inline])>
                        {{-- FLOATING LABEL--}}
                        @if ($label && $inline)
                            <span class="font-semibold">{{ $label }}</span>
                        @endif

                        <div @class(["w-full", "join" => $prepend || $append])>
                            {{-- PREPEND --}}
                            @if($prepend)
                                {{ $prepend }}
                            @endif

                            {{-- THE LABEL THAT HOLDS THE INPUT --}}
                            <label
                                @if($isDisabled())
                                    disabled
                                @endif

                               
                             >
                                {{-- PREFIX --}}
                                @if($prefix)
                                    <span class="label">{{ $prefix }}</span>
                                @endif

                                {{-- ICON LEFT --}}
                                @if($icon)
                                @endif

                                {{-- MONEY SETUP --}}
                                @if($money)
                                    <div
                                        class="w-full"
                                        x-data="{ amount: $wire.get('{{ $modelName() }}') }" x-init="$nextTick(() => new Currency($refs.myInput, {{ $moneySettings() }}))"
                                    >
                                @endif

                                    {{-- INPUT --}}
                                    <input
                                        id="{{ $uuid }}"
                                        placeholder="{{ $attributes->get('placeholder') }} "
                                        class="{{ $attributes->get('class')}}"
                                        @if($attributes->has('autofocus') && $attributes->get('autofocus') == true)
                                            autofocus
                                        @endif

                                        @if($money)
                                            x-ref="myInput"
                                            :value="amount"
                                            x-on:input="$nextTick(() => $wire.set('{{ $modelName() }}', Currency.getUnmasked(), {{ json_encode($attributes->wire('model')->hasModifier('live')) }}))"
                                            x-on:blur="$nextTick(() => $wire.set('{{ $modelName() }}', Currency.getUnmasked(), {{ json_encode($attributes->wire('model')->hasModifier('blur')) }}))"
                                            inputmode="numeric"
                                        @endif

                                        {{
                                            $attributes
                                                ->merge(['type' => 'text'])
                                                ->except($money ? ['wire:model', 'wire:model.live', 'wire:model.blur'] : '')
                                        }}
                                    />

                                {{-- HIDDEN MONEY INPUT + END MONEY SETUP --}}
                                @if($money)
                                        <input type="hidden" {{ $attributes->wire('model') }} />
                                    </div>
                                @endif

                                {{-- CLEAR ICON  --}}
                                @if($clearable)
                                @endif

                                {{-- ICON RIGHT --}}
                                @if($iconRight)
                                @endif

                                {{-- SUFFIX --}}
                                @if($suffix)
                                    <span class="label">{{ $suffix }}</span>
                                @endif
                            </label>

                            {{-- APPEND --}}
                            @if($append)
                                {{ $append }}
                            @endif
                        </div>
                    </label>

                    {{-- ERROR --}}
                    @if(!$omitError && $errors->has($errorFieldName()))
                        @foreach($errors->get($errorFieldName()) as $message)
                            @foreach(Arr::wrap($message) as $line)
                                <div class="{{ $errorClass }}" x-class="text-error">{{ $line }}</div>
                                @break($firstErrorOnly)
                            @endforeach
                            @break($firstErrorOnly)
                        @endforeach
                    @endif

                    {{-- HINT --}}
                    @if($hint)
                        <div class="{{ $hintClass }}" x-classes="fieldset-label">{{ $hint }}</div>
                    @endif
                </fieldset>
            </div>