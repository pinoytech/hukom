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
        <td class="tableTd">Address</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['corporate_partnership_info_id'].'</td>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['name'].'</td>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['nationality'].'</td>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['address'].'</td>';
    echo '<td class="tableTdContent">'.$row['BoardOfDirector']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

