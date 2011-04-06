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
        <td class="tableTd">First Name</td>
        <td class="tableTd">Middle Name</td>
        <td class="tableTd">Last Name</td>
        <td class="tableTd">Gender</td>
        <td class="tableTd">Birth Date</td>
        <td class="tableTd">Birth Place</td>
        <td class="tableTd">Address (Philippines)</td>
        <td class="tableTd">Address (Abroad)</td>
        <td class="tableTd">Telephone No.</td>
        <td class="tableTd">Cellphone No.</td>
        <td class="tableTd">Age</td>
        <td class="tableTd">Citizenship</td>
        <td class="tableTd">Education Attained</td>
        <td class="tableTd">School</td>
        <td class="tableTd">Company Work</td>
        <td class="tableTd">Nature Of Business</td>
        <td class="tableTd">Company Address</td>
        <td class="tableTd">Work Position</td>
        <td class="tableTd">Work Duration</td>
        <td class="tableTd">Work Status</td>
        <td class="tableTd">Civil Status</td>
        <td class="tableTd">Marriage Date</td>
        <td class="tableTd">Marriage Place</td>
        <td class="tableTd">Mother's Name</td>
        <td class="tableTd">Mother's Age</td>
        <td class="tableTd">Mother's Citizenship</td>
        <td class="tableTd">Mother's Address</td>
        <td class="tableTd">Father's Name</td>
        <td class="tableTd">Father's Age</td>
        <td class="tableTd">Father's Citizenship</td>
        <td class="tableTd">Father's Address</td>
        <td class="tableTd">Created</td>
    </tr>		
    <?php foreach($rows as $row):
    echo '<tr>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['id'].'</td>';
    echo '<td class="tableTdContent">'.$row['User']['username'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['first_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['middle_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['last_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['gender'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['birth_date'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['birth_place'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['address_ph'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['address_abroad'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['telephone_no'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['cellphone_no'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['age'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['citizenship'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['education_attained'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['school'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['company_work'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['nature_of_business'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['company_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['work_position'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['work_duration'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['work_status'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['civil_status'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['marriage_date'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['marriage_place'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['mothers_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['mothers_age'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['mothers_citizenship'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['mothers_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['fathers_name'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['fathers_age'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['fathers_citizenship'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['fathers_address'].'</td>';
    echo '<td class="tableTdContent">'.$row['PersonalInfo']['created'].'</td>';
    echo '</tr>';
    endforeach;
    ?>
</table>

