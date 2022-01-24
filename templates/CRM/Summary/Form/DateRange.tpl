
<div class="crm-section">
  <div class="label">{$form.start_date.label}</div>
  <div class="content">{$form.start_date.html}</div>
  <div class="clear"></div>
</div>


<div class="crm-section">
  <div class="label">{$form.end_date.label}</div>
  <div class="content">{$form.end_date.html}</div>
  <div class="clear"></div>
</div>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
{if !$allResults}
    <div class="results">
        {foreach from=$startResults item=result key=resultKey}
            <div class="item" style="text-align: center;">
                <strong>During this period was created:{$result} {$resultKey}s</strong>
            </div>
        {/foreach}
    </div>
{/if}

{*{if $allResults}*}
{*    <form action="mailto:mykola.havryliak@agiliway.com" method="POST">*}
{*        {foreach from=$allResults item=result key=resultKey}*}
{*            <input type="hidden" value="During this period was created:{$result} - {$resultKey}s">*}
{*            </input>*}
{*        {/foreach}*}
{*        <input type="submit" value="Send" />*}
{*    </form>*}
{*{/if}*}

<div class="results">
  {foreach from=$allResults item=result key=resultKey}
    <div class="item" style="text-align: center;">
        <strong>During this period was created:{$result} {$resultKey}s</strong>
    </div>
  {/foreach}
</div>

{literal}
    <script>
        if(jQuery(".crm-form-date")) {
            document.getElementById('end_date').value = '';
            document.getElementById('start_date').value = '';
        }
    </script>
{/literal}


