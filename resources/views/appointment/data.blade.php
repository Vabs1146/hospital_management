   <div class="form-group">
                        <label class="control-label col-sm-2" for="doctor_id">Doctor:</label>
                        <div class="col-sm-10"> 
                           <!--  {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, Request::old('doctor_id'), array('class' => 'form-control', 'required')) }} -->
                           <select name="doctor_id" id="doctor_id" class="form-control" placeholder="select your doctor">
                              
                               <?php 
                                    foreach($doctorlist11 as $doclist){
                                ?>
                               <option value="{{ $doclist->id }}">{{ $doclist->doctor_name }}</option>
                           <?php } ?>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Appointment Date:</label>
                        <div class="col-sm-10"> 
                       <input type="text" class="datepicker form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date." data-date-format="yyyy-mm-dd" required>
                           <!--  <input type="date" class=" form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date."> -->
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="control-label col-sm-2">Time Slot:</label>
                        <div class="col-sm-offset-2 col-sm-10">
                            <div id="Morning" class="align-items-center" style="display: none;margin-bottom: 5px;"><b>Morning Slot</b></div>
                            
                        <div id="appdate"></div>

                        </div>

                        

                         <div class="col-sm-offset-2 col-sm-10" style="margin-top: 18px;">
                            <div id="Afternoon" style="display: none;margin-bottom: 5px; "><b>Afternoon Slot</b></div>
                            
                        <div id="appdate2"></div>

                        </div>
                         <div class="col-sm-offset-2 col-sm-10" style="margin-top: 18px;">
                            <div id="Evening" style="display: none;margin-bottom: 5px; "><b>Evening Slot</b></div>
                            
                        <div id="appdate1"></div>

                        </div>
                    </div>