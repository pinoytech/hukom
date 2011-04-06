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
        <td class="tableTd">Spouse First Name</td>
        <td class="tableTd">Spouse Middle Name</td>
        <td class="tableTd">Spouse Last Name</td>
        <td class="tableTd">Spouse Gender</td>
        <td class="tableTd">Spouse Birth Date</td>
        <td class="tableTd">Spouse Birth Place</td>
        <td class="tableTd">Spouse Address (Philippines)</td>
        <td class="tableTd">Spouse Address (Abroad)</td>
        <td class="tableTd">Spouse Telephone No.</td>
        <td class="tableTd">Spouse Cellphone No.</td>
        <td class="tableTd">Spouse Age</td>
        <td class="tableTd">Spouse Citizenship</td>
        <td class="tableTd">Spouse Education Attained</td>
        <td class="tableTd">Spouse School</td>
        <td class="tableTd">Spouse Company Work</td>
        <td class="tableTd">Spouse Nature Of Business</td>
        <td class="tableTd">Spouse Company Address</td>
        <td class="tableTd">Spouse Work Position</td>
        <td class="tableTd">Spouse Work Duration</td>
        <td class="tableTd">Spouse Work Status</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['first_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['middle_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['last_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['gender'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['birth_date'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['birth_place'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['address_ph'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['address_abroad'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['telephone_no'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['cellphone_no'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['age'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['citizenship'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['education_attained'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['school'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['company_work'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['nature_of_business'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['company_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['work_position'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['work_duration'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['work_status'].'</td>';
    echo '<td class="tableTdContent">'.$row['SpouseInfo']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

