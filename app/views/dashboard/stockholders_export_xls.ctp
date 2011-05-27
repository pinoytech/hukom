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
        <td class="tableTd">Corporate Info ID</td>
        <td class="tableTd">Name</td>
        <td class="tableTd">Nationality</td>
        <td class="tableTd">No. of Shares</td>
        <td class="tableTd">Subscribed Capital</td>
        <td class="tableTd">Paid Up Capital</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['corporate_partnership_info_id'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['name'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['nationality'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['no_of_share'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['subscribed_capital'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['paid_up_capital'].'</td>';
    echo '<td class="tableTdContent">'.$row['Stockholder']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

