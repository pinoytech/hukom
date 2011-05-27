<style type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
		font-size: 14pt;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
	}
	#titles{
		font-weight: bolder;
	}   
</style>
<table>
    <tr id="titles">
        <td class="tableTd">ID</td>
        <td class="tableTd">Username</td>
        <td class="tableTd">Company/Partnership Name</td>
        <td class="tableTd">Type</td>
        <td class="tableTd">Principal Office Address</td>
        <td class="tableTd">Business Address</td>
        <td class="tableTd">Line Of Business</td>
        
        <td class="tableTd">Authorized Capital Stock/Partnership Capital</td>
        <td class="tableTd">No Of Shares</td>
        <td class="tableTd">Par Value</td>
        <td class="tableTd">No. of Share/s Subscribed</td>
        <td class="tableTd">Subscribed Capital</td>
        <td class="tableTd">Paid Up Capital</td>
        <td class="tableTd">Fiscal/Calendar Year</td>
        <td class="tableTd">Annual Meeting</td>
        <td class="tableTd">President</td>
        <td class="tableTd">Treasurer</td>
        <td class="tableTd">Secretary</td>
        <td class="tableTd">General Manager</td>
        <td class="tableTd">Managing Partners</td>
        <td class="tableTd">Stockholder Type</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['company_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['type'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['principal_office_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['business_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['line_of_business'].'</td>';
    
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['authorized_capital_stock_partnership_capital'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['no_of_shares'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['par_value'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['no_of_shares_subscribed'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['subscribed_capital'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['paid_up_capital'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['fiscal_calendar_year'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['annual_meeting'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['president'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['treasurer'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['secretary'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['general_manager'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['managing_partners'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['stockholder_type'].'</td>';
    echo '<td class="tableTdContent">'.$row['CorporatePartnershipInfo']['created'].'</td>';

    echo '</tr>';
    endforeach;
    ?>
</table>

