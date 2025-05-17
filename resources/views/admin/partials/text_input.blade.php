


                                        <!--begin::Input group-->
                                        <div class="fv-row w-100 flex-md-root">
                                            <!--begin::Label-->
                                           
                                            <label class="{{ $required ? 'required' : '' }} form-label">{{ $label }}</label>
                                            <!--end::Label-->
                                            <!--begin::Select2-->
                                       
                                            <input type="text" name="{{ $name }}" class="form-control mb-2" placeholder="{{ $label }}" value="{{ $value ?? '' }}" {{ $required ? 'required' : '' }} />
                                            <!--end::Select2-->

                                        </div>
                                        <!--end::Input group-->

                                    
                                        
