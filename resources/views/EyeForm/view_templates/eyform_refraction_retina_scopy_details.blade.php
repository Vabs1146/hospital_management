<div class="col-md-12">
   
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th colspan="4" class="text-center">Right</th>
                                    <th colspan="4" class="text-center">Left</th>
                                </tr>
                                <tr>
                                    <th>&nbsp;</th>
                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>
                                    <th>SPH</th>
                                    <th>CYL</th>
                                    <th>Axis</th>
                                    <th>Vision</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>D.V.</td>
                                    <td>
                                        {{ $glass_prescription->r_dv_sph }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_dv_cyl }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_dv_axi }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_dv_vision }}
                                    </td>
                                    
                                    <td>
                                        {{ $glass_prescription->l_dv_sph }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_dv_cyl }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_dv_axi }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_dv_vision }}
                                    </td>
                                </tr>
								<tr>
                                    <td>Add</td>
                                    <td>
                                        {{ ($glass_prescription->r_add_sph != '') ? $glass_prescription->r_add_sph : ''}}
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                        
                                    </td>
                                    
                                    <td>
                                        {{ ($glass_prescription->l_add_sph != '') ? $glass_prescription->l_add_sph : ''}}
                                    </td>
                                    <td>
                                       
                                    </td>
                                    <td>
                                        
                                    </td>
                                    <td>
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>N.V.</td>
                                    <td>
                                        {{ $glass_prescription->r_nv_sph }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_nv_cyl }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_nv_axi }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->r_nv_vision }}
                                    </td>
                                    
                                    <td>
                                        {{ $glass_prescription->l_nv_sph }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_nv_cyl }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_nv_axi }}
                                    </td>
                                    <td>
                                        {{ $glass_prescription->l_nv_vision }}
                                    </td>
                                    
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>