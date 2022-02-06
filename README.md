# Creating A Simple Lead Gen Form Plugin
## Task Descriptions
We would like you to create a simple WordPress plugin so that we may assess your core competency with WordPress functions and coding best practices, as well as basic PHP coding and security standards. We expect this project to take about ~4-5 hours and we hope that you can complete it in one day without too much trouble!

**The Goal** : We are building a simple CRM system for a client. The system will collect customer data and build customer profiles inside of the client’s WordPress Dashboard. They need to collect data from potential customers via a simple lead gen form and then have a list of customers that is easy to browse and keep track of. They want to be able to place this form anywhere. To do this, you will be creating a shortcode that generates a submission form with applicable fields. This form, when submitted, will save the submission as a private post as part of a custom post type called “Customer.” These posts can then be viewed, managed, tagged and categorized by the admin in the WordPress Dashboard.

- Create a shortcode that generates a form with the following fields: 
    - Name
    - Phone Number 
    - Email Address
    - Desired Budget 
    - Message
- The shortcode should include attributes that allows the admin to:
    - Override the labels/titles of the various fields, (e.g. ability to override label: "Name: " to "Your Full Name")
    - Set a max-length for any field.
    - Set rows and cols attributes of the Message text area.
- Style the contact form in a way that is presentable and readable.
    - Ensure that the form is optimized for mobile using responsive styling if necessary.
- Use Ajax to handle form submission.
- Fetch current date and time using a 3rd party API, adding that date and time to a hidden field in the form to be included in the post.
- Save the completed form submission to the database as a post in the “Customer” custom post type.
- These posts should not be viewable by the public.

## Solution
I've developed the plugin named "**Simple Lead Gen Form**" to achieve the goal. This plugin allow us to generate the dynamic form with dynamic fields and configuration with the help of shortcode.

Shortcode name : ``[simple-lead-gen-form]``

Below are the attributes for the form configuration that we can use in shortcode. 

name_label='Name'

phone_label='Phone Number' 

email_label='Email Address' 

budget_label='Desired Budget' 

message_label='Message' 

submit_label='Submit' 

name_maxlen='25' 

phone_maxlen='10' 

email_maxlen='25' 

budget_maxlen='10' 

message_maxlen='200' 

message_rows='3' 

message_cols='53'

Example : ``[simple-lead-gen-form name_label='Name' phone_label='Phone Number' email_label='Email Address' budget_label='Desired Budget' message_label='Message' submit_label='Submit' name_maxlen='25' phone_maxlen='10' email_maxlen='25' budget_maxlen='10' message_maxlen='200' message_rows='3' message_cols='53']``

## How to use
- Just download the code from repo that will generate the **simple-lead-gen-form** directory.
- Upload that plugin on plugin directory
- Go to plugin list from the admin dashboard and click on Install / Activate
- That's it.

You can just use shortcode as per below screenshot.