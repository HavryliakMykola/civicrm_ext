<div class="crm-block crm-form-block crm-summary-settings-form-block">
    <table class="form-layout-compressed">
        <tr>
            <td>
                {$form.from_email_address.label}<br />
                {$form.from_email_address.html}
            </td>
            <td>
                {$form.template_id.label}<br />
                {$form.template_id.html}
            </td>
        </tr>
        <tr>
            <td>
                {$form.from_email_address2.label}<br />
                {$form.from_email_address2.html}
            </td>
            <td>
                {$form.template_id2.label}<br />
                {$form.template_id2.html}
            </td>
        </tr>
    </table>
    <div class="crm-submit-buttons">{include file="CRM/common/formButtons.tpl" location="top"}</div>
</div>

