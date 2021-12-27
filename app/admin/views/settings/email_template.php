<?php
$link =Url::createLink('admin', 'setting', 'emailTemplate', ['id' => $this->id]);
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="wrap">
                    <form action="<?php echo $link ?>" method="post">
                        <table class="form" width="100%" border="0" cellspacing="2" cellpadding="3">
                            <tbody><tr>
                                <td class="fieldlabel w-md-20 text-md-right full_width_767">Template Name <font color="red">*</font></td>
                                <td class="fieldarea  block767 full_width_767">
                                    <input class="text full required" name="form[template_name]" style="padding:5px"
                                           value="<?php echo $this->data['template_name']?>" maxlength="255" type="text">
                                </td>
                            </tr>
                            <tr>
                                <td class="fieldlabel w-md-20 text-md-right full_width_767">From <font color="red">*</font></td>
                                <td class="fieldarea  block767 full_width_767">
                                    <input type="text" class="text full" name="form[from_name]" size="25"
                                           value="<?php echo $this->data['from_name']?>" placeholder="From name" data-enter-submit="true" style="width:40%">
                                    <input type="email" class="text full" name="form[from_email]" size="40"
                                           value="<?php echo $this->data['from_email']?>" data-enter-submit="true" placeholder="From email" style="width:40%">
                                </td>
                            </tr>
                            <tr>
                                <td class="fieldlabel w-md-20 text-md-right full_width_767"> Copy To </td>
                                <td class="fieldarea  full_width_767">
                                    <input type="text" name="form[copy_to]" size="50" style="padding:5px"
                                           value="<?php echo $this->data['copy_to']?>" data-enter-submit="true" placeholder="example@email.com,...">
                                    Enter email addresses separated by a comma
                                </td>
                            </tr>
                            <tr>
                                <td class="fieldlabel w-md-20 text-md-right full_width_767">Subject <font color="red">*</font></td>
                                <td class="fieldarea  full_width_767">
                                    <input class="text full required" name="form[subject]" style="padding:5px"
                                           value="<?php echo $this->data['subject']?>" maxlength="255" type="text" placeholder="Subject E-Mail">
                                </td>
                            </tr>
                            <tr>
                                <td class="fieldlabel w-md-20 text-md-right full_width_767 ">Content <font color="red">*</font></td>
                                <td class="fieldarea  block767 full_width_767">
                                    <textarea class="textarea email_template_content" name="form[content]" id="" cols="30" rows="10"><?php echo $this->data['content']?></textarea>
                                </td>
                            </tr>
                            </tbody></table>
                        <fieldset class="submit-buttons">
                            <button type="submit" name="button" id="submit_form" value="_EDIT" class="btn btn-primary start">
                                <i class="icon-ok icon-white"></i>
                                <span>Save</span>
                            </button>
                            <input value="Update" name="submit" type="hidden">
                        </fieldset>
                    </form>
                    <div class="wrap mt-4">
                        <div class="page-title">
                            <h4 class="font-italic">Available Merge Fields</h4>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 col-md-4">
                                <div class="row-field full_width">
                                    <div class="row-heading">Company</div>
                                    <div class="content coltrols" style="padding:0px">
                                        <ul class="wicket list-unstyled px-2 py-1">
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%PAGE_NAME%]">Company name</a>
                                                <span>[%PAGE_NAME%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%COMPANY_ADDRESS%]">Address</a>
                                                <span>[%COMPANY_ADDRESS%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%COMPANY_PHONE%]">Phone number</a>
                                                <span>[%COMPANY_PHONE%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%COMPANY_EMAIL%]">Email</a>
                                                <span>[%COMPANY_EMAIL%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%COMPANY_FAX%]">Fax</a>
                                                <span>[%COMPANY_FAX%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%COMPANY_WEBSITE%]">Webiste</a>
                                                <span>[%COMPANY_WEBSITE%]</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-md-4">
                                <div class="row-field full_width">
                                    <div class="row-heading">Customer</div>
                                    <div class="content coltrols" style="padding:0px">
                                        <ul class="wicket list-unstyled px-2 py-1">
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%CUSTOMER_FULLNAME%]">Full name</a>
                                                <span>[%CUSTOMER_FULLNAME%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%CUSTOMER_EMAIL%]">Email</a>
                                                <span>[%CUSTOMER_EMAIL%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%CUSTOMER_ADDRESS%]">Address</a>
                                                <span>[%CUSTOMER_ADDRESS%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%CUSTOMER_PHONE%]">Phone number</a>
                                                <span>[%CUSTOMER_PHONE%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%CUSTOMER_COUNTRY%]">Country</a>
                                                <span>[%CUSTOMER_COUNTRY%]</span>
                                            </li>
                                            <li>
                                                <a class="command" href="javascript:void();" data="[%DATETIME%]">Datetime</a>
                                                <span>[%DATETIME%]</span>
                                            </li>
                                            <li class="lastBorder">
                                                <a class="command" href="javascript:void();" data="[%UNSUBSCRIBE%]">Unsubscribe email</a>
                                                <span>[%UNSUBSCRIBE%]</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
