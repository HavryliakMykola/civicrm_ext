<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title></title>
</head>
<body>
    <table style="width: 100%; margin-bottom: 20px; border: 1px solid #dddddd;">
        <thead>
            <th colspan="2" style="font-weight: bold; padding: 5px; background: #efefef; border: 1px solid #dddddd;">During this period ({$startDate} - {$endDate}) was created :</th>
        </thead>
        <tbody>
            {foreach from=$allResults item=result key=resultKey}
                <tr>
                    <td style="border: 1px solid #dddddd; padding: 5px; width=50%;">{$result}</td>
                    <td style="border: 1px solid #dddddd; padding: 5px; width=50%;">{$resultKey}s</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</body>
</html>