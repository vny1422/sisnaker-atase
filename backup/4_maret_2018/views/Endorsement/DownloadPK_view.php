<style>
p{
    text-align:justify;
}
</style>
<body>

<table width="100%" width="100%" border="2px" cellspacing="1" cellpadding="4" class="table-bordered">
    <thead>
      <tr>
        <th colspan="3" style="text-align: center; padding: 5px;">CONTRACT OF SERVICE FOR DOMESTIC WORKERS</th>
      </tr>      
    </thead>
</table>

<?php
  $this->db->select('*');
  $this->db->where('idinstitution',$pk[0]["idinstitution"]);
  $country = $this->db->get('institution')->row_array();
?>

<p><b>AGREEMENT</b> made this <?= date("j F, Y") ?> between <?= $pk[0]["agnama"]; ?> (hereinafter called ‘The Employer’) and <?= $pk[0]["tknama"]; ?> (hereinafter called ‘The Employee’) whereby it is agreed that:-</p>

<p>
<b>DURATION</b><br>
1. The terms of this agreement are that the employee shall work for a period of two years starting from the date of arrival in the territory of employment. This term of service may be terminated in accordance with Clause 7.
</p>

<p>
<b>DUTIES</b><br>
2. The employee shall perform the normal duties as a <?= $pk[0]["namajenispekerjaan"]; ?> He/ she shall reside and work in <?= $country["nameinstitution"]; ?> or at any place in Borneo to which the employer may be transferred during the period of this AGREEMENT.
</p>

<p>
<b>WAGES</b><br>
3. (a) The employee will receive wages at a rate of not less than <?= $pk[0]["jpgaji"]; ?> per month. Wages are paid at the end of each month. The employer will provide free of charge facilities for the employee to make remittances to his/ her family or dependants in <?= $country["nameinstitution"]; ?>.<br>
(b) An allowance of <?php echo $pk[0]["jpgaji"]/30; ?> per day will be paid to the employee from the date of his/ her departure from .......... until his/ her arrival in <?= $country["nameinstitution"]; ?> and similarly on the return from <?= $country["nameinstitution"]; ?> to ...........
</p>

<p>
<b>WAGES</b><br>
3. (a) The employee will receive wages at a rate of not less than <?= $pk[0]["jpgaji"]; ?> per month. Wages are paid at the end of each month. The employer will provide free of charge facilities for the employee to make remittances to his/ her family or dependants in <?= $country["nameinstitution"]; ?>.<br>
(b) An allowance of <?php echo $pk[0]["jpgaji"]/30; ?> per day will be paid to the employee from the date of his/ her departure from .......... until his/ her arrival in <?= $country["nameinstitution"]; ?> and similarly on the return from <?= $country["nameinstitution"]; ?> to ...........
</p>

<p>
<b>PASSAGES</b><br>
4. The employer will provide the employee with free passage and food from .......... to <?= $country["nameinstitution"]; ?>. Similarly his/ her return voyage will be provided to .......... on this termination of this agreement. Necessary travel document and medical examinations required will be provided free of charge to the employee.
</p>

<p>
<b>FOOD & ACCOMODATION</b><br>
5. The employee will be provided with accommodation and food free of charge.
</p>

<p>
<b>MEDICAL</b><br>
6. The employer will arrange free medical treatment and attention in hospital for the duration of illness or accident with full wages for the first .......... *(specify numbers) days. There after wages will cease but medical treatment and attention will continue, if however, in the opinion of a qualified medical officer the employee will not be fit for further service with the employer within a reasonable time, arrangements will be made to repatriate the employee to .......... in which case the employee will be maintained in hospital until the date of departure (*Employee from outside Borneo must receive full wages for the first month of illness and half wages for the next month).
</p>

<p>
<b>TERMINATION</b><br>
7. (a) In the event of the employer wishing to terminate this agreement, he/ she will give one month’s notice or one month’s wages in lieu of notice, and the employer will provide free passage to ...........<br>
(b) In the event of the employee wishing to terminate this agreement he/ she will give one month’s notice or forfeit one month’s wages in lieu thereof to the employer. In this event he/ she will be repatriated at the employer’s expense.
</p>

<p>
<b>DISMISSAL</b><br>
8.	The employer shall reserve the right summarily to dismiss the employee for cause shown, in which case the employee will be repatriated to .......... at the first opportunity at the employer’s expense but wages will cease as from the day of dismissal.<br>
The competent authority will be informed should the employee be dismissed under this clause.
</p>

<p>
<b>LAWS</b><br>
9. The employee will be subject to the laws of the territory in which he/ she is employed during the cause of his/ her agreement.
</p>

<p>
<b>SIGNING OF AGREEMENT</b><br>
10. This agreement will not be signed in .......... but will be signed on arrival in <?= $country["nameinstitution"]; ?> and in the presence of the Competent Authority.
</p>

<p>
<b>COMPLAINTS</b><br>
11.	All complaints concerning the terms of this agreement must be made before the Competent Authority (Labour Commisioner or Deputy Commisioner of Labour) before the employee leaves the country of employment.
</p>

<p>
<b>FINAL</b><br>
12.	On termination of this contract all final payments, no complaints certificates etc., should be made in the presence of the Commisioner of Labour or Deputy Commisioner of Labour before the employee leaves the country of employment.
</p>

<p>
<b>INTERPRETATION</b><br>
13.	In the interpretation of this agreement only the English text will be accepted.
</p>

<br><br><br><br><br><br>
<div style="margin-left: 150px; margin-right:150px">................................&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;................................</div>
<div style="margin-left: 150px; margin-right:150px">(Signed by Employer)&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;(Signed by Employee)</div>


<pagebreak>

<p>
Explained by :<br><br>
In the presence of
</p>

<table width="100%" width="100%" border="2px" cellspacing="1" cellpadding="4" class="table-bordered">
    <thead>
      <tr>
        <th colspan="3" style="text-align: center; padding: 5px;">COMMISINER OF LABOUR<br><?= $country["nameinstitution"]; ?></th>
      </tr>      
    </thead>
</table>

<p>
<b>POSTCRIPT</b>
</p>
<p>
1. Any complaints concerning payments of wages should be made during the month of payments and not at the end of the contract when it is difficult to verify the matter for past and previous month.<br>
2. The employee concerned in this contract is permitted entry and residence inti <?= $country["nameinstitution"]; ?> only for the purpose of employment with the employer mentioned in this contract. The employee is not authorized by me to work for any other employment elsewhere without my authority, the reason for the employee’s entry and permission to reside cease. The employee is therefore an illegal immigrant and the employer is required to report the matter both to myself and the Immigration Officer.
</p>

<p style="text-align:center;">
<b>FOR OFFICIAL USE</b>
</p>
<p style="text-align:center;">
TYPE OF PASSPORT <?php echo $pk[0]["tkpaspor"]; ?><br>
DATE OF ARRIVAL ...........<br>
VALID UNTIL ...........<br>
REMARKS ...........<br>
</p>
</body>
