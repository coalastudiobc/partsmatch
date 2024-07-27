<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Order Commission Type</label>
                <input type="hidden" name="order_commission_type" value="Percentage" id="checktype" class=" checktype">
                <div class="custm-dropdown">
                    <div class="dropdown checktype">
                        <div class="dropdown-toggle form-control" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            <div id="selectedcommission">
                                Percentage

                            </div>
                            <span class="custm-drop-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="23" viewBox="0 0 24 23" fill="none">
                                    <path d="M19 9.00006L14 14.0001L9 9.00006" stroke="#151515" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </span>
                        </div>
                        
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">

                            <li><a class="dropdown-item custom_dropdown_commission" data-value="Percentage" data-text="Percentage" href="javascript:void(0)">Percentage</a>
                            </li>
                            <li><a class="dropdown-item custom_dropdown_commission" data-value="Fixed" data-text="Fixed" href="javascript:void(0)">Fixed</a>
                            </li>

                        </ul>
                    </div>
                </div>
                                                                    
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Order Commission<span class="required-field">*</span></label>
                <div class="symbol">%</div>
                <input type="number" id="checkcommission" name="order_commission" class="form-control  two-decimals" value="">

                                                                    <div class="input-icon-custm tooltip-open">
                    <span>
                        <i class="fa-solid fa-question"></i>
                    </span>
                    <div class="tooltip">
                        <p>ghfvjvhm</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <button class="btn primary-btn float-end" id="submit" type="submit">Submit</button>
        </div>
    </div>
</div>