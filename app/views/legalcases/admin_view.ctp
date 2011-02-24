<?php
// debug($Legalcase);
?>
<div class="users view">
<h2><?php  __('Case');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['Legalcase']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['Legalcase']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['Legalcase']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['Legalcase']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php echo $this->element('admin_navigation'); ?>
<div class="users view">
<h2><?php  __('Summary of Information');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Legal Problem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcase['Legalcase']['legal_problem']; ?>
			&nbsp;
		</dd>
		<?php
		// debug($Legalcase['Legalcasedetail']);
		foreach ($Legalcase['Legalcasedetail'] as $Legalcasedetail) {
		?>
		
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Summary of Facts'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['summary']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Objectives'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['objectives']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Questions'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $Legalcasedetail['questions']; ?>
			&nbsp;
		</dd>
		
			<dt style="color:red">Payment Information</dt>
		
			<?php
			if (isset($Legalcase['Bankdeposit'])) {
				foreach ($Legalcase['Bankdeposit'] as $Bankdeposit) {
					if ($Legalcasedetail['id'] == $Bankdeposit['case_detail_id']) {
			?>
		
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Bank'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['bank']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Branch'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['branch']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Deposited'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['date_deposited']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Country'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['country']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['amount']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reference No.'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['reference_no']; ?>
				&nbsp;
			</dd>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('File'); ?></dt>
			<dd<?php if ($i++ % 2 == 0) echo $class;?>>
				<?php echo $Bankdeposit['file']; ?>
				&nbsp;
			</dd>
			<?php
					}
				}
			}
			?>
		
		<?php
		}
		?>
	</dl>
	<br />
	<div>
		<?php echo $this->Html->link(__('Edit', true), array('admin' => true, 'action' => 'edit', $Legalcase['Legalcase']['id'])); ?>
	</div>
</div>


