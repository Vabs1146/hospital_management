  <!--  <div class="checkbox">
                           <label><input type="radio" name="morningEvening" id="morningEvening" value="Morning" required /> Morning </label>
                           <label><input type="radio" name="morningEvening" id="morningEvening" value="Evening" required /> Evening </label>
                           {{-- <input type="hidden" name="appointment_dt" id="appointment_dt" /> --}}
                       </div> -->
                      <!--  <?php 
                            // foreach($timeslot as $timeslots){
                         ?>
                            <div class="col-xs-3">
                                <label><input type="radio" name="morningEvening" id="morningEvening" value="{{  $timeslots->starttime }}" required>&nbsp;{{  $timeslots->starttime }}</label>
                          <input type="hidden" name="appointment_dt" id="appointment_dt" />
                            </div>
                         <?php } ?>  --> 



                         <div class="form-group">
                        <label class="control-label col-sm-2" for="doctor_id">Doctor:</label>
                        <div class="col-sm-10"> 
                           <!--  {{ Form::select('doctor_id', array(''=>'Please select') + $doctorList, Request::old('doctor_id'), array('class' => 'form-control', 'required')) }} -->
                           <select name="doctor_id" id="doctor_id" class="form-control" placeholder="select your doctor">
                              
                              <!--  <?php 
                                   //foreach($doctorlist11 as $doclist){
                               ?>
                              <option value="{{ $doclist->id }}">{{ $doclist->doctor_name }}</option>
                                                         <?php } ?> -->
                                                         <option value="13">DR.Aher</option>
                           </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Appointment Date:</label>
                        <div class="col-sm-10"> 
                            <!-- <input type="date" class="datepicker form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date." required> -->
                            <!-- <input type="date" class=" form-control" id="appointment_dt" name="appointment_dt" placeholder="Select Date."> -->
                            <input type="text" name="appointment_dt" value="26/01/2020">
                        </div>
                    </div>
                    <div class="form-group"> 
                        <label class="control-label col-sm-2">Time Slot:</label>
                        <div class="col-sm-offset-2 col-sm-10">
                            

                        <div id="appdate"></div>
                        </div>
                    </div>
                </div>