/*
 * Additional function for forms.html
 *	Written by ThemePixels	
 *	http://themepixels.com/
 *
 *	Copyright (c) 2012 ThemePixels (http://themepixels.com)
 *	
 *	Built for Katniss Premium Responsive Admin Template
 *  http://themeforest.net/category/site-templates/admin-templates
 */

jQuery(document).ready(function(){

    // Transform upload file
    /*jQuery('.uniform-file').uniform();

     // Date Picker
     jQuery("#datepicker").datepicker();

     // Dual Box Select
     var db = jQuery('#dualselect').find('.ds_arrow button');	//get arrows of dual select
     var sel1 = jQuery('#dualselect select:first-child');		//get first select element
     var sel2 = jQuery('#dualselect select:last-child');			//get second select element

     sel2.empty(); //empty it first from dom.

     db.click(function(){
     var t = (jQuery(this).hasClass('ds_prev'))? 0 : 1;	// 0 if arrow prev otherwise arrow next
     if(t) {
     sel1.find('option').each(function(){
     if(jQuery(this).is(':selected')) {
     jQuery(this).attr('selected',false);
     var op = sel2.find('option:first-child');
     sel2.append(jQuery(this));
     }
     });
     } else {
     sel2.find('option').each(function(){
     if(jQuery(this).is(':selected')) {
     jQuery(this).attr('selected',false);
     sel1.append(jQuery(this));
     }
     });
     }
     return false;
     });

     // Tags Input
     jQuery('#tags').tagsInput();

     // Spinner
     jQuery("#spinner").spinner({min: 0, max: 100, increment: 2});

     // Character Counter
     jQuery("#textarea2").charCount({
     allowed: 120,
     warning: 20,
     counterText: 'Characters left: '
     });

     // Select with Search
     jQuery(".chzn-select").chosen();

     // Textarea Autogrow
     jQuery('#autoResizeTA').autogrow();


     // With Form Validation
     jQuery("#form1").validate({
     rules: {
     firstname: "required",
     lastname: "required",
     email: {
     required: true,
     email: true,
     },
     location: "required",
     selection: "required"
     },
     messages: {
     firstname: "Please enter your first name",
     lastname: "Please enter your last name",
     email: "Please enter a valid email address",
     location: "Please enter your location"
     },
     highlight: function(label) {
     jQuery(label).closest('.control-group').addClass('error');
     },
     success: function(label) {
     label
     .text('Ok!').addClass('valid')
     .closest('.control-group').addClass('success');
     }
     });

     //time picker
     //jQuery('#timepicker1').timepicker();


     // color picker
     if(jQuery('#colorpicker').length > 0) {
     jQuery('#colorSelector').ColorPicker({
     onShow: function (colpkr) {
     jQuery(colpkr).fadeIn(500);
     return false;
     },
     onHide: function (colpkr) {
     jQuery(colpkr).fadeOut(500);
     return false;
     },
     onChange: function (hsb, hex, rgb) {
     jQuery('#colorSelector span').css('backgroundColor', '#' + hex);
     jQuery('#colorpicker').val('#'+hex);
     }
     });
     }*/
    /*  jQuery.validator.addMethod("number",function(value,element)
     {
     return this.optional(element) || /^[0-9]{10,10}$/i.test(value);
     },"mobile number must be 10 digits");
     jQuery.validator.addMethod("userName",function(value,element)
     {
     return this.optional(element) || /^(([a-zA-Z0-9][_|.])*([a-zA-Z0-9]))$/i.test(value);
     },"");
     */

    // With Form Validation
    jQuery.validator.addMethod("number",function(value,element)
    {
        //return this.optional(element) || /^[0-9]{10,10}$/i.test(value);
        return this.optional(element) || /^(?:[1-9]\d*|0)?(?:\.\d+)?$/i.test(value);

    },"Mobile Number Must Be 10 Digits");

    jQuery.validator.addMethod('filesize', function(value, element, param) {
            // param = size (en bytes)
            // element = element to validate (<input>)
            // value = value of the element (file name)
            return this.optional(element) || (element.files[0].size <= param)
        },"File Size Must Be LessThen 10MB"
    );
    jQuery.validator.addMethod("notEqual",
        function(value, element, param) {
            return this.optional(element) || value !== param;
        },
        "Please Select Package"
    );
    jQuery.validator.addMethod("image",function(value,element)
    {
        return this.optional(element) ||  (/\.(gif|jpg|jpeg|tiff|png)$/i).test(value);
    },"Please Select .jpeg.gif.png Formats Only ");

    jQuery.validator.addMethod("float",function(value,element)
    {
        return this.optional(element) ||  (/\.(gif|jpg|jpeg|tiff|png)$/i).test(value);
    },"Please Select .jpeg.gif.png Formats Only ");

    jQuery("#addCommunityForm").validate({
        rules: {
            image:{
                image:true,
                filesize: 10485760
            },
            communityName:"required",
            package_id:{
                required: true,
                notEqual: '0'
            },
            pincode:{
                pincode:true

            }
        },
        messages: {
            communityName:{
                required: "Please Enter Community Name"
            },
            package_id :{
                required:"Please Select Package"
            }

        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


    jQuery.validator.addMethod("pincode",function(value,element)
    {
        return this.optional(element) ||  (/^\d{6}$/).test(value);
    },"Pincode Contains 6 Digits Only ");

    jQuery("#editCommunityForm").validate({
        rules: {
            image:{
                image:true,
                filesize: 10485760
            },
            communityName:"required",
            package_id:{
                required: true,
                notEqual: '0'
            },
            pincode:{
                pincode:true

            }
        },
        messages: {
            communityName:{
                required: "Please Enter Community Name"
            },
            package_id :{
                required:"Please Select Package"
            }

        },
        /* submitHandler: function(form) {
         validateCommunity();
         //form.submit();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#resetPassword").validate({
        rules: {
            NewPassword:{
                required: true,
                minlength: 6,
                maxlength:10
            },
            ConformPassword:{
                required: true,
                equalTo: "#NewPassword",
                minlength: 6,
                maxlength:10
            }
        },
        messages: {
            NewPassword:{
                required: "Please Enter New Password",
                minlength: "Please Enter Minimum 6 Characters",
                maxlength:"Please Enter Maximum 10 Characters"
            },
            ConformPassword:{
                required: "Please Enter Confirm Password",
                minlength: "Please Enter Minimum 6 Characters",
                maxlength:"Please Enter Maximum 10 Characters",
                equalTo:"Password Mismatch"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#addCommunityUserForm").validate({

        rules: {
            select:'required',
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            image:{
                image: true,
                filesize: 10485760
            }
        },
        messages: {
            select:{
                required:"Please Select Community"
            },
            firstName:{
                required: "Please Enter  First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#editCommunityUserForm").validate({
        rules: {
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:"Please Enter Registration Number"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


    jQuery('#addPackage').validate({
        rules: {
            packageName:"required",
            packageDuration: "required",
            packageAmount:{
                required: true,
                digits: true
            },
            'module[]':"required"
        },
        messages: {
            packageName:{
                required: "Please Enter Package Name"
            },
            packageDuration:{
                required: "Please Select Package Duration"
            },
            packageAmount:{
                required: "Please Enter Package Amount",
                digits: 'Please Enter Amount Only'
            },
            'module[]':{
                required:""
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery('#editPackage').validate({
        rules: {
            packageName:"required",
            packageDuration: "required",
            packageAmount:{
                required: true,
                digits: true
            },
            'module[]':"required"
        },
        messages: {
            packageName:{
                required: "Please Enter Package Name"
            },
            packageDuration:{
                required: "Please Select Package Duration"
            },
            packageAmount:{
                required: "Please Enter Package Amount",
                digits: 'Please Enter Amount Only'
            },
            'module[]':{
                required:""
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery('#reNewCommunityForm').validate({
        rules: {
            package_id:{
                required: true ,
                notEqual: '0'
            }
        },
        messages: {
            package_id:{
                required: "Please Select Package",
                notEqual: "Please Select Package"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


    jQuery("#addBlock").validate({
        rules: {
            blockName:{
                required: true
            }
        },
        messages: {
            blockName:{
                required: "Please Enter Block Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#updateBlock").validate({
        rules: {
            blockName:{
                required: true
            }
        },
        messages: {
            blockName:{
                required: "Please Enter Block Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery('#editUserProfileForm').validate({
        rules: {
            firstName:"required",
            userName:"required",
            number: "number",
            image:{
                image:true
            }
            //lastName: "required",
            //number:  "required number" ,
        },
        messages: {
            firstName:{
                required: "Please Enter  First Name"
            },
            lastName: "Please Enter  Last Name",
            userName:{
                required:"Please Enter Name"
            },
            number:{
                required:"Please Enter Valid Number"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


     jQuery("#changeCommunityUserPassword").validate({
        rules: {
            OldPassword:{
                required: true,
                minlength: 6,
                maxlength:10
            },
            NewPassword:{
                required: true,
                minlength: 6,
                maxlength:10
            },
            ConformPassword:{
                required: true,
                equalTo: "#NewPassword",
                minlength: 6,
                maxlength:10
            }
        },
        messages: {
            OldPassword:{
                required: "Please Enter Old Password",
                minlength: "Please Enter Minimum 6 Characters",
                maxlength:"Please Enter Maximum 10 Characters"
            },
            NewPassword:{
                required: "Please Enter New Password",
                minlength: "Please Enter Minimum 6 Characters",
                maxlength:"Please Enter Maximum 10 Characters"
            },
            ConformPassword:{
                required: "Please Enter Confirm Password",
                minlength: "Please Enter Minimum 6 Characters",
                maxlength:"Please Enter Maximum 10 Characters",
                equalTo:"Password Mismatch"
            }
        },
        submitHandler: function(form) {
            changePassword();
            //form.submit();
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery.validator.addMethod("notEqual",
        function(value, element, param) {
            return this.optional(element) || value !== param;
        }
    );
    jQuery("#addFlat").validate({
        rules: {
            flatNumber:{
                required: true ,
                digits: true
            },
            flatBlockId:{
                required: true ,
                notEqual: '0'
            }
        },
        messages: {
            flatNumber:{
                required: "Please Enter Flat Number" ,
                digits:'Please Enter Digits Only'
            },
            flatBlockId:{
                required: "Please Select Block",
                digits: "Please Select Block" ,
                notEqual:'Please Select Block'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#editFlatForm").validate({
        rules: {
            flatNumber:{
                required: true,
                digits: true
            },
            flatType:{
                required: true,
                notEqual: '0'
            },
            superBuiltupArea:{
                required: true,
                notEqual: '0',
                digits: true
            },
            plotArea:{
                required: true,
                digits: true,
                notEqual: '0'
            }
        },
        messages: {
            flatNumber:{
                required: "Please Enter Flat Number",
                digits: "Please Enter Numbers Only"
            },
            flatType:{
                required: "Please Select Flat Type",
                notEqual: "Please Select Flat Type"
            },
            superBuiltupArea:{
                required: "Please Select  Area",
                notEqual: "Please Select  Area",
                digits: "Please Enter Numbers Only"
            },
            plotArea:{
                required: "Please Select Plot Area",
                notEqual: "Please Select Plot Area",
                digits: "Please Enter Numbers Only"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#add_document_header").validate({
        rules: {
            header_name:{
                required: true
            }
        },
        messages: {
            header_name:{
                required: "Please Enter Header Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


    jQuery("#update_document_header").validate({
        rules: {
            header_name:{
                required: true
            }
        },
        messages: {
            header_name:{
                required: "Please Enter Header Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery.validator.addMethod("document",function(value,element)
    {
        return this.optional(element) ||  (/\.(xls|XL|xlsx|pdf|msword)$/i).test(value);
    });
    jQuery("#add_document").validate({
        rules: {
            document:{
                required: true,
                document: true,
                filesize: 10485760
            }
        },
        messages: {
            document:{
                required: "Please Select Document",
                document:'Please Select .xls , .xlsx ,.pdf Formats Only'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    //members
    jQuery("#addMember").validate({
        rules: {
            BlockId:{
                required: true,
                notEqual: "0"
            },
            FlatNumber:{
                required: true,
                notEqual: "0"
            },
            FlatRole:{
                required: true,
                notEqual: "0"
            },
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            FlatNumber:{
                required:"Please Select Flat Number",
                notEqual: "Please Select Flat Number"
            },BlockId:{
                required:"Please Select Block",
                notEqual: "Please Select Block"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            FlatRole:{
                required:"Please Select Role",
                notEqual: "Please Select Role"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery.validator.addMethod("VehicleRegistrationNumber",function(value,element)
    {
        return this.optional(element) ||  (/^[A-Z]{2}[ -][0-9]{1,2}(?: [A-Z])?(?: [A-Z]*)? [0-9]{4}$/).test(value);
    });
    jQuery("#editMember").validate({
        rules: {
            firstName:"required",
            number: {
                digits: true,
                number: true
            },
            NoOfVehicles:{
                digits: true
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            NoOfVehicles:{
                digits:  "Please Enter Numbers Only"
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:"Invalid Registration Number"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery.validator.addMethod("upload_flat_members",function(value,element)
    {
        return this.optional(element) ||  (/\.(xls|XL|xlsx)$/i).test(value);
    });
    jQuery("#upload_flat_members").validate({
        rules: {
            upload_flat_members: {
                required: true,
                upload_flat_members: true,
                filesize: 10485760
            }
        },
        messages: {
            upload_flat_members: {
                required: "Please Select File " ,
                upload_flat_members:'Please Select .xls , .xlsx Formats Only'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery.validator.addMethod("upload_flats",function(value,element)
    {
        return this.optional(element) ||  (/\.(xls|XL|xlsx)$/i).test(value);
    });
    jQuery("#upload_flats").validate({
        rules: {
            upload_flats: {
                required: true,
                upload_flats: true,
                filesize: 10485760
            }
        },
        messages: {
            upload_flats: {
                required: "Please Select File " ,
                upload_flats:'Please Select .xls , .xlsx Formats Only'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addMantenanceMember').validate({
        rules: {
            committee_role:{
                required: true,
                notEqual: '0'
            },
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            committee_role:{
                required:"Please Select Role",
                notEqual:"Please Select Role"
            },
            firstName:{
                required: "Please Enter First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editMaintenanceMemberForm").validate({
        rules: {
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            NoOfVehicles:{
                digits: true
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            NoOfVehicles:{
                digits:  "Please Enter Numbers Only"
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:"Please Enter Registration Number"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addRole').validate({
        rules: {
            roleName:"required"
        } ,
        messages: {
            roleName:{
                required: "Please Enter Role Name "
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#editRole').validate({
        rules: {
            roleName:"required"
        } ,
        messages: {
            roleName:{
                required: "Please Enter Role Name "
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addCommitteeMember").validate({
        rules: {
            committeeRole:{
                required: true,
                notEqual: '0'
            },
            BlockId:{
                required: true,
                notEqual: '0'
            },
            FlatNumber:{
                required: true,
                notEqual: '0'
            },
            flatMember:{
                required: true,
                notEqual: '0'
            }

        },
        messages: {

            committeeRole:{
                required:"Please Select Role",
                notEqual:"Please Select Role"
            },
            BlockId:{
                required:"Please Select Block",
                notEqual:"Please Select Block"
            },
            FlatNumber:{
                required:"Please Select Flat Number",
                notEqual:"Please Select Flat Number"
            },
            flatMember:{
                required:"Please Select Flat Member",
                notEqual:"Please Select Flat Member"
            }


        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editCommitteeMember").validate({
        rules: {
            firstName:"required",
            number: {
                digits: true,
                number: true
            },
            NoOfVehicles:{
                digits: true
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:true
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            NoOfVehicles:{
                digits:  "Please Enter Numbers Only"
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:"Please Enter Registration Number"
            }

        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addCommitteeRole").validate({
        rules: {
            roleName:{
                required: true
            },
            'module[]':{
                required: true
            }
        },
        messages: {
            roleName:{
                required: "Please Enter Committee Role"
            },
            'module[]':{
                required: ""
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#updateCommitteeRole").validate({
        rules: {
            roleName:{
                required: true
            },
            'module[]':{
                required: true
            }
        },
        messages: {
            roleName:{
                required: "Please Enter Committee Role"
            },
            'module[]':{
                required: ""
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addStaffMemberForm").validate({
        rules: {
            committee_role:{
                required: true,
                notEqual: '0'
            },
            firstName:"required",
            email: {
                required: true,
                email: true },
            number:  {
                digits: true,
                number: true
            },
            BlockId:{
                required: true,
                notEqual: '0'
            },
            FlatNumber:{
                required: true,
                notEqual: '0'
            },
            flatMember:{
                required: true,
                notEqual: '0'
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            committee_role:{
                required:"Please Select Role",
                notEqual:"Please Select Role"
            },
            BlockId:{
                required:"Please Select Block",
                notEqual:"Please Select Block"
            },
            FlatNumber:{
                required:"Please Select Flat",
                notEqual:"Please Select Flat"
            },
            number:{
                digits: "Please Enter Numbers Only"
            },
            flatMember:{
                required:"Please Select Member",
                notEqual:"Please Select Member"
            }

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editStaffMember").validate({
        rules: {
            firstName:"required",
            number:{
                digits: true,
                number: true
            },
            NoOfVehicles:{
                digits: true
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:true
            },
            image:{
                image:true,
                filesize: 10485760
            }
        },
        messages: {
            firstName:{
                required: "Please Enter First Name"
            } ,
            number:{
                digits: "Please Enter Numbers Only"
            },
            NoOfVehicles:{
                digits:  "Please Enter Numbers Only"
            },
            VehicleRegistrationNumber:{
                VehicleRegistrationNumber:"Please Enter Registration Number"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addContactDirectory').validate({
        rules: {
            title:"required",
            contactPerson: "required",
            contactNumber: {
                required: true,
                digits: true }
        },
        messages: {
            title:{
                required: "Please Enter Title"
            },
            contactPerson:{
                required: "Please Enter Person Name"
            },
            contactNumber:{
                required: "Please Enter Contact Number" ,
                digits: "Please Enter Numbers Only"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#editContactDirectoryForm').validate({
        rules: {
            title:"required",
            contactPerson: "required",
            contactNumber: {
                required: true,
                digits: true }
        },
        messages: {
            title:{
                required: "Please Enter Title"
            },
            contactPerson:{
                required: "Please Enter Person Name"
            },
            contactNumber:{
                required: "Please Enter Contact Number" ,
                digits: "Please Enter Numbers Only"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addClassifiedForm').validate({
        rules: {
            classifiedName:"required",
            classified_category:{
                required: true,
                notEqual: '0'
            },
            classified_type_id: {
                required: true,
                notEqual: '0'
            },
            image:{
                image:true,
                filesize: 10485760
            },
            price: {
                required: true,
                digits: true,
                maxlength:7
            },
            expire_date: {
                required: true
            }
        },
        messages: {
            classifiedName:{
                required: "Please Enter Name"
            },
            classified_category:{
                required: "Please Select Category",
                notEqual: "Please Select Category"
            },
            classified_type_id:{
                required: "Please Select Type",
                notEqual: "Please Select Type"
            },
            price:{
                required: "Please Enter Price",
                digits: "Please Enter Digits Only",
                maxlength:"Please Enter Maximum 7 digits"
            },
            expire_date: "Please Select Date"
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addAsset").validate({
        rules: {
            asset_group: {
                required: true,
                notEqual: '0'
            },
            asset_number: "required",
            asset_name: "required",
            purchase_cost:{
                digits:true,
                maxlength:7
            }
        },
        messages: {
            asset_group: {
                required: "Please Select Asset Group ",
                notEqual: "Please Select Asset Group "
            },
            asset_number : "Please Enter Asset Number",
            asset_name: "Please Enter Asset Name" ,
            purchase_cost:{
                digits:"Please Enter Digits Only",
                maxlength:"Please Enter 7 Digits Only"
            }

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editAsset").validate({
        rules: {
            asset_group: {
                required: true,
                notEqual: '0'
            },
            asset_number: "required",
            asset_name: "required",
            purchase_cost:{
                digits:true,
                maxlength:7
            }
        },
        messages: {
            asset_group: {
                required: "Please Select Asset Group ",
                notEqual: "Please Select Asset Group "
            },
            asset_number : "Please Enter Asset Number",
            asset_name: "Please Enter Asset Name",
            purchase_cost:{
                digits:"Please Enter Digits Only",
                maxlength:"Please Enter 7 Digits Only"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#add_asset_group").validate({
        rules: {
            assetGroupName: "required"
        },
        messages: {
            assetGroupName:"Please Enter Asset Group Name"

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#update_asset_group").validate({
        rules: {
            assetGroupName: "required"
        },
        messages: {
            assetGroupName:"Please Enter Asset Group Name"

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    //3-5-2014
    jQuery("#addAssetMaintenance").validate({
        rules: {
            maintenance_member: {
                required: true,
                notEqual: '0'
            },
            due_date: "required"
        },
        messages: {
            maintenance_member: {
                required: "Please Select Member ",
                notEqual: "Please Select Member"
            },
            due_date : "Please Select Date"

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#updateAssetMaintenance").validate({
        rules: {
            maintenance_member: {
                required: true,
                notEqual: '0'
            },
            due_date: "required"
        },
        messages: {
            maintenance_member: {
                required: "Please Select Member ",
                notEqual: "Please Select Member"
            },
            due_date : "Please Enter Due Date"

        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
     jQuery.validator.addMethod("phoneNumber",function(value,element)
    {
        return this.optional(element) ||  (/^[0-9,-]{10,12}$/).test(value);
    });
    jQuery('#addComplaintCategory').validate({
        rules: {
            complaintCategoryName:"required",
            phoneNumber:{
                required:true,
                phoneNumber:true,
                maxlength:12,
                minlength:10
            }
        } ,
        messages: {
            complaintCategoryName:{
                required: "Please Enter Category Name "
            },
            phoneNumber:{
                required:"Please Enter Phone Number",
                phoneNumber:"Allows Only Numbers And '-'",
                maxlength:"Please Enter Total 12 digits Only",
                minlength:"In Correct Phone Number"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#editComplaintCategory').validate({
        rules: {
            complaintCategoryName:"required",
            phoneNumber:{
                required:true,
                phoneNumber:true,
                maxlength:12,
                minlength:10
            }
        } ,
        messages: {
            complaintCategoryName:{
                required: "Please Enter Category Name "
            },
            phoneNumber:{
                required:"Please Enter Phone Number",
                phoneNumber:"Allows Only Numbers And '-'",
                maxlength:"Please Enter Total 12 digits Only",
                minlength:"In Correct Phone Number"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addNotice').validate({
        rules: {
            title:"required",
            expiry_date:"required",
            community_id:{
                required: true,
                notEqual: '0'
            },
            BlockId:{
                required: true,
                notEqual: '0'
            },
            FlatNumber:{
                required: true,
                notEqual: '0'
            }
        } ,
        messages: {
            title:{
                required: "Please Enter Title "
            },
            expiry_date:{
                required: "Please Select Date "
            },
            community_id:{
                required: "Please Select Community",
                notEqual: "Please Select Community"
            },
            BlockId:{
                required: "Please Select Block",
                notEqual: "Please Select Block"
            },
            FlatNumber:{
                required: "Please Select Flat",
                notEqual: "Please Select Flat"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#editNotice').validate({
        rules: {
            title:"required",
            expiry_date:"required",
            community_id:{
                required: true,
                notEqual: '0'
            },
            BlockId:{
                required: true,
                notEqual: '0'
            },
            FlatNumber:{
                required: true,
                notEqual: '0'
            }
        } ,
        messages: {
            title:{
                required: "Please Enter Title "
            },
            expiry_date:{
                required: "Please Select Date "
            },
            community_id:{
                required: "Please Select Community",
                notEqual: "Please Select Community"
            },
            BlockId:{
                required: "Please Select Block",
                notEqual: "Please Select Block"
            },
            FlatNumber:{
                required: "Please Select Flat",
                notEqual: "Please Select Flat"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#addComplaint').validate({
        rules: {
            complaint_category:{
                required: true,
                notEqual: '0'
            },
            assigned_to:{
                required: true,
                notEqual: '0'
            },
complaintSummary:"required",
            description:"required",
            attachment:{
                filesize: 10485760
            }
        } ,
        messages: {
            complaint_category: {
                required: "Please Select Category ",
                notEqual: "Please Select Category"
            },
            assigned_to: {
                required: "Please Select Member ",
                notEqual: "Please Select Member"
            },
            description:{
                required: "Please Enter Description"
            },
            complaintSummary:{
                required: "Please Enter Complaint Summary"
            }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#editComplaint').validate({
        rules: {
            complaint_category:{
                required: true,
                notEqual: '0'
            },
            assigned_to:{
                required: true,
                notEqual: '0'
            },
            description:{
                required: true
            },
            attachment:{
                filesize: 10485760
            }/*,
             description:"required"*/
        } ,
        messages: {
            complaint_category: {
                required: "Please Select Category ",
                notEqual: "Please Select Category"
            },
            assigned_to: {
                required: "Please Select Member ",
                notEqual: "Please Select Member"
            },
             description:{
             required: "Please Enter Comment"
             }
        },

        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery('#facility_form').validate({
        rules: {
            facility_name:"required" ,
            price:{
                required:true,
                digits:true,
                maxlength:7
            },
             contact_person_name:{
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone_number:{
                required: true,
                digits: true,
                number: true
            },
            bookings_per_slot:{
                required:true,
                digits:true
            },
            slot_duration:{
                required:true,
                notEqual: '0',
                digits:true
            }
        } ,
        messages: {
            facility_name:{
                required: "Please Enter Name"
            },
            price:{
                digits:"Please Enter Digits Only",
                required:"Please Enter Price",
                maxlength:"Please Enter 7 Digits Only"
            },
            contact_person_name:{
                required: "Please Enter Contact Person Name "
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            phone_number:{
                required: "Please Enter Phone Number",
                digits: "Please Enter Digits Only",
                number: "Please Enter Digits Only"
            },
            bookings_per_slot:{
                required:"Please Enter Number of Bookings",
                digits: "Please Enter Digits Only"
            },
            slot_duration:{
                required:"Please Enter Duration",
                notEqual:"Please Enter Duration",
                digits: "Please Enter  Duration"
            }
        },
        submitHandler: function(form) {
            timeSchedule();
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addVendorCategory").validate({
        rules: {
            categoryName:{
                required: true
            }
        },
        messages: {
            categoryName:{
                required: "Please Enter Category Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#updateVendorCategory").validate({
        rules: {
            vendorCategoryName:{
                required: true
            }
        },
        messages: {
            vendorCategoryName:{
                required: "Please Enter Category Name"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addVendor").validate({
        rules: {
            vendor_category:{
                required: true,
                notEqual:'0'
            },
            vendor_name:{
                required: true
            },
            contact_person_name:{
                required: true
            },
            email: {
                required: true,
                email: true
            },
            contact_number:{
                digits: true,
                number: true
            }
        },
        messages: {
            vendor_category:{
                required: "Please Select Category",
                notEqual: "Please Select Category"
            },
            vendor_name:{
                required: "Please Enter Name"
            },
            contact_person_name:{
                required: "Please Enter Name"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            contact_number:{
                digits: 'Please Enter Numbers Only.'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editVendor").validate({
        rules: {
            vendor_category:{
                required: true,
                notEqual:'0'
            },
            vendor_name:{
                required: true
            },
            contact_person_name:{
                required: true
            },
            email: {
                required: true,
                email: true
            },
            contact_number:{
                digits: true,
                number: true
            }
        },
        messages: {
            vendor_category:{
                required: "Please Select Category",
                notEqual: "Please Select Category"
            },
            vendor_name:{
                required: "Please Enter Name"
            },
            contact_person_name:{
                required: "Please Enter Name"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            contact_number:{
                digits: 'Please Enter Numbers Only.'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addAccountUserForm").validate({
        rules: {
            accountNumber:{
                required: true,
                digits: true
            },
            nickName:{
                required: true
            },
            branchLocation:{
                required: true
            },
            branchCity:{
                required: true
            },
            branchAddress: {
                required: true
            } ,
            openingBalance :{
                required: true ,
                digits: true
            }
        },
        messages: {
            accountNumber:{
                required: "Please Enter Account Number",
                digits:'Please Enter Number Only'
            },
            nickName: {
                required: "Please Enter Nick Name"
            },
            branchLocation:{
                required:"Please Enter Branch Location"
            },
            branchCity:{
                required:"Please Enter Branch City"
            },
            branchAddress:{
                required:"Please Enter Branch Address"
            },
            openingBalance :{
                required:"Please Enter Opening Balance" ,
                digits:'Please Enter Numbers Only'
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addAdvertisement").validate({
        rules: {
            title:{
                required: true
            },
            description:{
                required: true
            }
        },
        messages: {
            title:{
                required: "Please Enter Title"
            },
            description:{
                required: "Please Enter Description"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#updateAdvertisement").validate({
        rules: {
            title:{
                required: true
            },
            description:{
                required: true
            }
        },
        messages: {
            title:{
                required: "Please Enter Title"
            },
            description:{
                required: "Please Enter Description"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#editClassifiedForm").validate({
        rules: {
            classifiedName:{
                required: true
            },
            classified_category:{
                required: true,
                notEqual: '0'
            },
            classified_type_id: {
                required: true,
                notEqual: '0'
            },
            price: {
                required: true,
                digits: true,
                maxlength:7
            }

        },
        messages: {
            classifiedName:{
                required: "Please Enter ClassifiedName"
            },
            price:{
                required: "Please Enter Price",
                digits: "Please Enter Price Only",
                maxlength:"Please Enter Maximum 7 digits"
            },
            classified_category:{
                required: "Please Select Category",
                notEqual: "Please Select Category"
            },
            classified_type_id:{
                required: "Please Select Type",
                notEqual: "Please Select Type"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addBooking").validate({
        rules: {
            date_of_booking:{
                required: true
            }
        },
        messages: {
            date_of_booking:{
                required: "Please Select Date Of Booking"
            }
        },
        submitHandler: function(form) {
            addBookingTimeSchedule();
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addBill").validate({
        rules: {
            due_date:{
                required: true
            }
        },
        messages: {
            due_date:{
                required: "Please Select Due Date"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#addBookingPayment").validate({
        rules: {
            payment_mode:{
                required: true
            },
            amount:{
                required: true,
                number: true
            },
            payment_date:{
                required: true
            }
        },
        messages: {
            payment_mode:{
                required: "Please Select Payment Mode"

            },
            amount:{
                required: "Please Enter Amount",
                number: "Enter Numbers Only"
            },
            payment_date:{
                required: "Please Select Payment Date"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#vendorBill").validate({
        rules: {
            vendor_id:{
                required: true,
                notEqual: '0'
            },
            expenditure_type:{
                required: true,
                notEqual: '0'
            },
            amount:{
                required: true,
                number: true,
                maxlength:7
            },
            bill_number:{
                digits: true,
                maxlength:5
            },
            bill_date:{
                required: true
            },
            due_date:{
                required: true
            }
        },
        messages: {
            vendor_id:{
                required: "Please Select Vendor Name",
                notEqual: "Please Select Vendor Name"

            },
            expenditure_type:{
                required: "Please Select Expenditure Type",
                notEqual: "Please Select Expenditure Type"
            },
            amount:{
                required: "Please Enter Amount",
                number: "Please Enter Digits Only",
                maxlength:"Please Enter Maximum 7 Digits"
            },
            bill_number:{
                digits: "Please Enter Digits Only",
                maxlength:"Please Enter Maximum 5 Digits"
            },
            bill_date:{
                required: "Please Select Bill Date"
            },
            due_date:{
                required: "Please Select Due Date"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#bill_template_form").validate({
        rules: {
            template_name:{
                required: true
            }
        },
        messages: {
            template_name:{
                required: "Please Enter Template Name"

            }
        },
        submitHandler: function(form) {
            billTemplateFormValidation();
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });
    jQuery("#generateBill").validate({
        rules: {
            'bill_templates[]':{
                required: function (element) {
                    //alert(jQuery('[name="bill_templates[]"]:checked').length);
                    var len = jQuery("input[name='bill_templates[]']").length;
                    var valid=0;
                    if(jQuery('[name="bill_templates[]"]:checked').length==0)
                    {
                        jQuery("#errorSpan").text("Please Select At Least One File");
                        valid++;
                    }else{
                        jQuery("#errorSpan").text("");
                    }
                    for(var i=0;i<len;i++){
                        var nameFeild="bill_template_file_"+i;
                        if(jQuery("#bill_templates"+i).is(':checked'))
                        {

                            if(jQuery("#"+nameFeild).val() == ''){
                                jQuery("#error_id_"+i).text("Please Select Attachment");
                                jQuery("#error_id_"+i).attr("class","error");
                                valid++;
                            }else{
                                var fileName=jQuery("#"+nameFeild).val();
                                var fileType1=fileName.split('.');
                                var imageExtention=new Array("xls","XL","xlsx");
                                if((imageExtention.indexOf(fileType1[1]))==-1){
                                    jQuery("#error_id_"+i).text("upload Only xls,XL,xlsx Formats");
                                    jQuery("#error_id_"+i).attr("class","error");
                                    valid++;
                                }else{
                                    jQuery("#error_id_"+i).text("");
                                    jQuery("#error_id_"+i).removeAttr("class","error");
                                }
                            }
                        }else{
                            jQuery("#"+nameFeild).val('');
                            jQuery("#error_id_"+i).text("");
                            jQuery("#error_id_"+i).removeAttr("class","error");
                        }
                    }
                    if(valid!=0){
                        return true;
                    }
                }
            },
            bill_name:{
                required: true
            },
            due_date:{
                required: true
            }
        },
        messages: {
            due_date:{
                required: "Please Select Due Date"
            },
            'bill_templates[]':{
                required:""
            },
            bill_name:{
                required: "Please Enter Bill Title"
            }
        },
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success')
                .closest('.control-group').removeClass('error');
        }
    });

    jQuery("#school_form").validate({
        rules: {
            school_name:{
                required: true
            },
            school_logo:{
                required: function() {
                        if($('#id_school').val()===0){
                            return true;
                        }
                        else return false;
                },
                image:true,
                filesize: 10485760
            },
            address:{
                required: true
            },
            country_id:{
                required: true,
                notEqual: '0'
            },
            state_id:{
                required: true,
                notEqual: '0'
            },
            city_id:{
                required: true,
                notEqual: '0'
            },
            first_name:{
                required: true
            },
            last_name:{
                required: true
            },
            email:{
                required: true
            },
            phone_number:{
                required: true,
                digits: true,
                number: true
            }
        },
        messages: {
            school_name:{
                required: "Please Enter School Name"
            },
            school_logo:{
                required: "Please Select School logo",
                image: "Please Select Image"
            },
            address:{
                required: "Please Enter Address"
            },
            country_id:{
                required: "Please Select Country",
                notEqual: "Please Select Country"
            },
            state_id:{
                required: "Please Select State",
                notEqual: "Please Select State"
            },
            city_id:{
                required: "Please Select City",
                notEqual: "Please Select City"
            },
            first_name:{
                required: "Please Enter First Name"
            },
            last_name:{
                required: "Please Enter Last Name"
            },
            email:{
                required: "Please Enter Email"
            },
            phone_number:{
                required: "Please Enter Phone Number"
            }
        },
        /*submitHandler: function(form) {
            //billTemplateFormValidation();
        },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#academic_form").validate({
        rules: {
            name:{
                required: true
            },
            start_date:{
                required: true
            },
            end_date:{
                required: true
            },
            description:{
                required: true
            }
        },
        messages: {
            name:{
                required: "Please Enter Name"
            },
            start_date:{
                required: "Please Enter Start Date"
            },
            end_date:{
                required: "Please Enter End Date"
            },
            description:{
                required: "Please Enter Description"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#board_form").validate({
        rules: {
            name:{
                required: true
            },
            description:{
                required: true
            }
        },
        messages: {
            name:{
                required: "Please Enter Name"
            },
            description:{
                required: "Please Enter Description"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#course_form").validate({
        rules: {
            board_id:{
                required: true,
                notEqual: '0'
            },
            name:{
                required: true
            },
            code:{
                required: true
            }
        },
        messages: {
            board_id:{
                required: "Please Select Board",
                notEqual: 'Please Select Board'
            },
            name:{
                required: "Please Enter Name"
            },
            code:{
                required: "Please Enter code"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#subject_form").validate({
        rules: {
            course_id:{
                required: true,
                notEqual: '0'
            },
            name:{
                required: true
            },
            code:{
                required: true
            }
        },
        messages: {
            course_id:{
                required: "Please Select Course",
                notEqual: "Please Select Course",
            },
            name:{
                required: "Please Enter Name"
            },
            code:{
                required: "Please Enter Code"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });


    jQuery("#category_form").validate({
        rules: {
            category_name:{
                required: true
            }
        },
        messages: {
            category_name:{
                required: "Please Enter Category Name"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#department_form").validate({
        rules: {
            department_name:{
                required: true
            }
        },
        messages: {
            department_name:{
                required: "Please Enter Department Name"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

   jQuery("#staff_details").validate({
        rules: {
            teacher_number:{
                required: true
            },
            last_name:{
                required: true
            },
            first_name:{
                required:true
            },
            gender:{
                required: true,
                notEqual: '0'
            },
            date_of_birth:{
                required: true
            },
            qualification:{
                required: true
            },
            year:{
                required: true,
                notEqual: '0'
            },
            months:{
                required: true,
                notEqual: '0'
            },
            email: {
                required: true,
                email: true
            },
            phone_number:{
                required:true,
                phoneNumber:true,
                maxlength:12,
                minlength:10
            }
        },
        messages: {
            teacher_number:{
                required: "Please Enter Teacher Number"
            },
            first_name:{
                required: "Please Enter First Name"
            },
            last_name:{
                required:"Please Enter Last Name"
            },
            gender:{
                required: "Please Select Gender",
                notEqual: "Please Select Gender"
            },
            date_of_birth:{
                required: "Please Select Date Of Birth"
            },
            qualification:{
                required: "Please Enter Qualification"
            },
            year:{
                required: "Please Select Year",
                notEqual: "Please Select Year"
            },
            months:{
                required: "Please Select Months",
                notEqual: "Please Select Months"
            },
            email: {
                required: "Please Enter Email",
                email: "Please Enter Valid Email"
            },
            phone_number:{
                required:"Please Enter Phone Number",
                phoneNumber:"Allows Only Numbers And '-'",
                maxlength:"Please Enter Total 12 digits Only",
                minlength:"In Correct Phone Number"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#staff_contact_details").validate({
        rules: {
            home_address_line1:{
                required: true
            },
            home_city:{
                required: true
            },
            home_state:{
                required:true
            },
            home_country_id:{
                required: true,
                notEqual: '0'
            },
            home_pincode:{
                required: true
            }
        },
        messages: {
            home_address_line1:{
                required: "Please Enter Home Address"
            },
            home_city:{
                required: "Please Enter Home City"
            },
            home_state:{
                required:"Please Enter Home State"
            },
            home_country_id:{
                required: "Please Select Country",
                notEqual: "Please Select Country"
            },
            home_pincode:{
                required: "Please Enter Home Pincode"
            }
        },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

    jQuery("#staff_documents2").validate({
            rules: {
                document:{
                    required: true,
                    document: true,
                    filesize: 10485760
                }
            },
            messages: {
                document:{
                    required: "Please Select Document",
                    document:'Please Select .xls , .xlsx ,.pdf Formats Only'
                }
            },
        /*submitHandler: function(form) {
         //billTemplateFormValidation();
         },*/
        highlight: function(label) {
            jQuery(label).closest('.control-group').addClass('error');
        },
        success: function(label) {
            label
                .text('').addClass('valid')
                .closest('.control-group').addClass('success');
        }
    });

});
