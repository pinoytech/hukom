<style type="text/css">
	.tableTd {
	   	border-width: 0.5pt; 
		border: solid; 
		font-size: 14pt;
	}
	.tableTdContent{
		border-width: 0.5pt; 
		border: solid;
        font-size: 14pt;
	}
	#titles{
		font-weight: bolder;
	}
   
</style>
<table>
    <tr id="titles">
        <td class="tableTd">Case ID</td>
        <td class="tableTd">Username</td>
        <td class="tableTd">Legal Problem</td>
        <td class="tableTd">Case Detail ID</td>
        <td class="tableTd">Legal Service</td>
        <td class="tableTd">Summary</td>
        <td class="tableTd">Objectives</td>
        <td class="tableTd">Questions</td>
        <td class="tableTd">Status</td>
        <td class="tableTd">Date</td>
        
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['Legalcase']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcase']['legal_problem'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['legal_service'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['summary'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['objectives'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['questions'].'</td>';    
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['status'].'</td>';
    echo '<td class="tableTdContent">'.$row['Legalcasedetail']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

