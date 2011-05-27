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
        <td class="tableTd">Name</td>
        <td class="tableTd">Sex</td>
        <td class="tableTd">Birth Date</td>
        <td class="tableTd">School</td>
        <td class="tableTd">Grade Year</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['name'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['sex'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['birth_date'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['school'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['grade_year'].'</td>';
    echo '<td class="tableTdContent">'.$row['ChildrenList']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

