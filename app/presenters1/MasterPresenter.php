<?php
namespace App\Presenters;
use Nette;
use App\Model;
use Nette\Application\UI;
use Nette\Application\UI\Form;
class MasterPresenter extends UI\Presenter{
    /** @var Nette\Database\Context */
    private $database;
    public function __construct(Nette\Database\Context $database){
        $this->database = $database;
    }
    public function renderDefault(){
    	// $this->template->datas = $this->database->table('master_currency_formats')->order('master_currency_format_id DESC');
    	// $this->template->cnt = 0;
	}
	/*
     *Code start for master currency format setting
	*/    
	public function renderCurrencyFormat(){
    	$this->template->datas = $this->database->table('master_currency_formats')->order('master_currency_format_id DESC');
    	$this->template->cnt = 0;
	}
	protected function createComponentCurrencyFormat(){
		$appearanceList = array('Pre'=>'Pre','Post'=>'Post');
	    $form = new UI\Form;
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addText('currency_name', 'Currency Name :')->setRequired("Please enter currency name");
	    $form->addTextArea('symbol', 'Symbol:')->setRequired("Please enter symbol");
	    $form->addSelect('appearance', 'Appearance:',$appearanceList)->setPrompt('— select any Appearance —')->setRequired();
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'currencyFormatSucceeded');
	    return $form;
	}
	public function currencyFormatSucceeded($form, $values){
	    $master_currency_format_id = $this->getParameter('master_currency_format_id');
	    if($master_currency_format_id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_currency_formats')->get($master_currency_format_id);
	        $post->update($values);
	        $this->flashMessage('Currency was updated', 'success');
	    }else{
	        $post = $this->database->table('master_currency_formats')->insert($values);
	        $this->flashMessage('Currency was saved', 'success');
	    }
	    $this->redirect('currencyFormat');
	}
	public function actionCurrencyFormatEdit($master_currency_format_id){
	    $data = $this->database->table('master_currency_formats')->get($master_currency_format_id);
	    if (!$data) {
	        $this->error('Data not found');
	    }
	    $this['currencyFormat']->setDefaults($data->toArray());
	}
	public function actionCurrencyFormatDelete($master_currency_format_id){
		$data = $this->database->table('master_currency_formats')->where('master_currency_format_id', $master_currency_format_id)->delete();
		if(!$data){
			$this->flashMessage('Invalid request for delete', 'success');
		}else{
			$this->flashMessage('Currency was deleted', 'success');
		}
		$this->redirect('currencyFormat');
	}
	/*
     *Code start for master date time setting
	*/
	public function renderDateTimeSetting(){
		$this->template->datetimes = $this->database->table('master_date_times')->order('master_date_time_id DESC');
		$this->template->cnt = 0;
	}
	public function createComponentDateTimeSetting(){
	    $form = new UI\Form;
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('modified_by')->setValue(date(1));
	    $form->addText('short_date_format', 'Short Date Format :')->setRequired();
	    $form->addText('long_date_format', 'Long Date Format:')->setRequired();
	    $form->addText('time_format', 'Time Format:')->setRequired();
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'dateTimeSucceeded');
	    return $form;
	}	
	public function dateTimeSucceeded($form, $values){
	    $master_date_time_id = $this->getParameter('master_date_time_id');
	    if($master_date_time_id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_date_times')->get($master_date_time_id);
	        $post->update($values);
	        $this->flashMessage('Date Time was updated', 'success');
	    }else{
	        $post = $this->database->table('master_date_times')->insert($values);
	        $this->flashMessage('Date Time was saved', 'success');
	    }
	    $this->redirect('dateTimeSetting');		
	}
	public function actionDateTimeEdit($master_date_time_id){
	    $data = $this->database->table('master_date_times')->get($master_date_time_id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['dateTimeSetting']->setDefaults($data->toArray());
	}
	public function actionDateTimeDelete($master_date_time_id){
		$data = $this->database->table('master_date_times')->where('master_date_time_id', $master_date_time_id)->delete();
		if(!$data){
			$this->flashMessage('Invalid request for delete', 'success');
		}else{
			$this->flashMessage('Date time was deleted', 'success');
		}
		$this->redirect('dateTimeSetting');		
	}
	/*
     *Code start for master mail setting
	*/ 
	public function rendermailSetting(){
		$this->template->mails = $this->database->table('master_mail_settings')->order('master_mail_setting_id DESC');
		$this->template->cnt = 0;
	}		
	public function createComponentMailSetting(){
		$htmlList = array('Y'=>'Yes','N'=>'No');
		$sequreConnection = array(''=>'No','ssl'=>'SSL','tls');
	    $form = new UI\Form;
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('modified_by')->setValue(date(1));
	    $form->addText('from_mail', 'From Mail Id :')->setRequired("Please enter from mail id");
	    $form->addText('sender_name', 'Sender Name :')->setRequired("Please enter from name");
	    $form->addText('smtp_server', 'SMTP Server :')->setRequired("Please enter SMTP server address");
	    $form->addPassword('password', 'SMTP Password:')->setRequired("please enter SMTP password");
	    $form->addSelect('sequre_connection', 'Sequre Connection:',$sequreConnection)->setRequired();
	    $form->addText('smtp_port', 'Smtp Port:')->setRequired("please enter SMTP port");
	    $form->addText('smtp_port', 'Smtp Port:')->setRequired("please enter SMTP port");
	    $form->addSelect('is_html', 'Is Html?:',$htmlList)->setRequired();
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'mailSettingSucceeded');
	    return $form;
	}	
	public function mailSettingSucceeded($form, $values){
	    $master_mail_setting_id = $this->getParameter('master_mail_setting_id');
	    if($master_mail_setting_id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_mail_settings')->get($master_mail_setting_id);
	        $post->update($values);
	        $this->flashMessage('Mail Setting was updated', 'success');
	    }else{
	        $post = $this->database->table('master_mail_settings')->insert($values);
	        $this->flashMessage('Mail Setting was saved', 'success');
	    }
	    $this->redirect('mailSetting');		
	}
	public function actionMailEdit($master_mail_setting_id){
	    $data = $this->database->table('master_mail_settings')->get($master_mail_setting_id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['mailSetting']->setDefaults($data->toArray());
	}
	public function actionMailDelete($master_mail_setting_id){
		$data = $this->database->table('master_mail_settings')->where('master_mail_setting_id', $master_mail_setting_id)->delete();
		if(!$data){
			$this->flashMessage('Invalid request for delete', 'success');
		}else{
			$this->flashMessage('Mail setting was deleted', 'success');
		}
		$this->redirect('mailSetting');	
	}
	/*
     *Code start for master Organization
	*/ 
	public function renderOrganization(){
		$this->template->datas = $this->database->table('organizations')->order('organization_id DESC');
		$this->template->cnt = 0;
	}		
	public function createComponentOrganization(){
		$htmlList = array('Y'=>'Yes','N'=>'No');
	    $form = new UI\Form;
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);

	    $form->addUpload('favicon', 'Upload Favicon :')
	    ->addRule(Form::IMAGE, 'Thubnail must be JPEG, PNG or GIF')
	    //->addRule(Form::MAX_FILE_SIZE, 'verifies maximal file size')
	    //->addRule(Form::MIME_TYPE, 'checks if MIME type is valid')	    
	    ->setRequired('Please upload Favicon');

	    $form->addUpload('logo', 'Upload Logo:')
	    ->addRule(Form::IMAGE, 'Thubnail must be JPEG, PNG or GIF')
	    //->addRule(Form::MAX_FILE_SIZE, 'verifies maximal file size')
	    //->addRule(Form::MIME_TYPE, 'checks if MIME type is valid')	  	    
	    ->setRequired('Please upload Logo');

	    $form->addUpload('banner', 'Upload Banner:')
	    ->addRule(Form::IMAGE, 'Thubnail must be JPEG, PNG or GIF')
	    //->addRule(Form::MAX_FILE_SIZE, 'verifies maximal file size')
	    //->addRule(Form::MIME_TYPE, 'checks if MIME type is valid')
	    ->setRequired('Please upload Banner');

	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'organizationSucceeded');
	    return $form;
	}	
	public function organizationSucceeded($form, $values){
		$faviconImageName = $values['favicon']->getSanitizedName();
		if($faviconImageName){
			$values['favicon']->move(__DIR__.'/../../files/OrganizationDoc/'.$faviconImageName);
			$values['favicon'] = $faviconImageName;
		}
		$logoImageName = $values['logo']->getSanitizedName();
		if($logoImageName){
			$values['logo']->move(__DIR__.'/../../files/OrganizationDoc/'.$logoImageName);
			$values['logo'] = $logoImageName;
		}
		$bannerImageName = $values['banner']->getSanitizedName();
		if($bannerImageName){
			$values['banner']->move(__DIR__.'/../../files/OrganizationDoc/'.$bannerImageName);
			$values['banner'] = $bannerImageName;
		}
	    $organization_id = $this->getParameter('organization_id');
	    if($organization_id) {
	    	unset($values['created']);
	        $post = $this->database->table('organizations')->get($organization_id);
	        $post->update($values);
	        $this->flashMessage('Organization was updated', 'success');
	    }else{
	        $post = $this->database->table('organizations')->insert($values);
	        $this->flashMessage('Organization was saved', 'success');
	    }
	    $this->redirect('organization');		
	}
	/**
	 * @author :subrat
	 * @date dgdfgfdg
	 * [foo description]
	 */

	public function actionOrganizationEdit($organization_id){
	    $data = $this->database->table('organizations')->get($organization_id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['organization']->setDefaults($data->toArray());
	}
	public function actionOrganizationDelete($organization_id){
		$data = $this->database->table('organizations')->where('organization_id', $organization_id)->delete();
			if(!$data){
				$this->flashMessage('Invalid request for delete', 'success');
			}else{
				$this->flashMessage('Organization was deleted', 'success');
			}
		$this->redirect('organization');	
	}
	/**
	 * @author  : Subrata <[subrata.rout@lipl.in]>
	 * @date( 29th dec, 2015)
	 * [foo description]
	 */
	public function renderWing(){
		$this->template->datas = $this->database->table('master_wings')->where('is_trash', 0)->order('id DESC');
		$this->template->cnt = 0;
	}
	public function createComponentWing(){
		$wings = array(0=>'— Select any Wing —');
		$wings += $this->database->table('master_wings')->where('is_trash', 0)->where('is_enable', 1)->fetchPairs('id', 'name');
	    $form = new UI\Form;
	   	$form->addText('name', 'Wing Name :')->setRequired("Please enter wing name");
	    $form->addText('wing_head', 'Wing Head :')->setRequired("Please enter Wing Head");
	    $form->addSelect('parent_id', 'Parent Wing :',$wings);
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);	    
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'wingSucceeded');
	    return $form;
	}	
	public function wingSucceeded($form, $values){
	    $id = $this->getParameter('id');
	    if($id){
	    	unset($values['created']);
	        $post = $this->database->table('master_wings')->get($id);
	        $post->update($values);
	        $this->flashMessage('Wing was updated', 'success');
	    }else{
	        $post = $this->database->table('master_wings')->insert($values);
	        $this->flashMessage('Wing was saved', 'success');
	    }
	    $this->redirect('wing');		
	}
	public function actionWingEdit($id){
	    $data = $this->database->table('master_wings')->get($id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['wing']->setDefaults($data->toArray());
	}
	public function actionWingDelete($id){
		$values['is_trash'] = 1;
        $post = $this->database->table('master_wings')->get($id);
		if($post->update($values)){
			$this->flashMessage('Wing was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('wing');	
	}
	public function actionWingAction($id){
        $post = $this->database->table('master_wings')->get($id);
        if(isset($post['is_enable']) && $post['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($post->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('Wing was enabled', 'success');
			}else{
				$this->flashMessage('Wing was disabled', 'danger');
			}
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('wing');		
	}	
	public function renderSection(){
		$this->template->datas = $this->database->table('master_sections')->where('is_trash', 0)->order('id DESC');
		$this->template->cnt = 0;
	}
	public function createComponentSection(){
		$wings = $this->database->table('master_wings')->where('is_trash', 0)->where('is_enable', 1)->fetchPairs('id', 'name');
	    $form = new UI\Form;
	   	$form->addText('name', 'Section Name :')->setRequired("Please enter section name");
	    $form->addSelect('wing_id', 'Wing Name :',$wings)->setPrompt('— Select any Wing —')->setRequired("Please select wing name");
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);

	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'sectionSucceeded');
	    return $form;
	}	
	public function sectionSucceeded($form, $values){
	    $id = $this->getParameter('id');
	    if($id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_sections')->get($id);
	        $post->update($values);
	        $this->flashMessage('Section was updated', 'success');
	    }else{
	        $post = $this->database->table('master_sections')->insert($values);
	        $this->flashMessage('Section was saved', 'success');
	    }
	    $this->redirect('section');		
	}
	public function actionSectionEdit($id){
	    $data = $this->database->table('master_sections')->get($id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['section']->setDefaults($data->toArray());
	}
	public function actionSectionDelete($id){
		$values['is_trash'] = 1;
        $post = $this->database->table('master_sections')->get($id);
		if($post->update($values)){
			$this->flashMessage('Section was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('section');	

	}
	public function actionSectionAction($id){
        $post = $this->database->table('master_sections')->get($id);
        if(isset($post['is_enable']) && $post['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($post->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('Section was enabled', 'success');
			}else{
				$this->flashMessage('Section was disabled', 'danger');
			}
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('section');		
	}		
	public function renderDesignation(){
		$this->template->datas = $this->database->table('master_designations')->where('is_trash', 0)->order('id DESC');
		$this->template->cnt = 0;
	}
	public function createComponentDesignation(){
		$sections = $this->database->table('master_sections')->where('is_trash', 0)->where('is_enable', 1)->fetchPairs('id', 'name');
	    $form = new UI\Form;
	   	$form->addText('name', 'Designation :')->setRequired("Please enter section name");
	    $form->addSelect('section_id', 'Section :',$sections)->setPrompt('— Select any Section —')->setRequired("Please select section");
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);

	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'designationSucceeded');
	    return $form;
	}	
	public function designationSucceeded($form, $values){
	    $id = $this->getParameter('id');
	    if($id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_designations')->get($id);
	        $post->update($values);
	        $this->flashMessage('Designation was updated', 'success');
	    }else{
	        $post = $this->database->table('master_designations')->insert($values);
	        $this->flashMessage('Designation was saved', 'success');
	    }
	    $this->redirect('designation');		
	}
	public function actionDesignationEdit($id){
	    $data = $this->database->table('master_designations')->get($id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['designation']->setDefaults($data->toArray());
	}
	public function actionDesignationDelete($id){
		$values['is_trash'] = 1;
        $post = $this->database->table('master_designations')->get($id);
		if($post->update($values)){
			$this->flashMessage('Designation was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('designation');	
	}
	public function actionDesignationAction($id){
        $post = $this->database->table('master_designations')->get($id);
        if(isset($post['is_enable']) && $post['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($post->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('Designation was enabled', 'success');
			}else{
				$this->flashMessage('Designation was disabled', 'danger');
			}
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('designation');		
	}		
	public function renderUsertype(){
		$this->template->datas = $this->database->table('master_user_type')->where('is_trash', 0)->order('id DESC');
		$this->template->cnt = 0;
	}
	public function createComponentUsertype(){
		$form = new UI\Form;
	   	$form->addText('name', 'User Type :')->setRequired("Please enter user type");
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'usertypeSucceeded');
	    return $form;
	}	
	public function usertypeSucceeded($form, $values){
	    $id = $this->getParameter('id');
	    if($id) {
	    	unset($values['created']);
	        $post = $this->database->table('master_user_type')->get($id);
	        $post->update($values);
	        $this->flashMessage('User type was updated', 'success');
	    }else{
	        $post = $this->database->table('master_user_type')->insert($values);
	        $this->flashMessage('User type was saved', 'success');
	    }
	    $this->redirect('usertype');		
	}
	public function actionUsertypeEdit($id){
	    $data = $this->database->table('master_user_type')->get($id);
	    if (!$data) {
	        $this->error('Post not found');
	    }
	    $this['usertype']->setDefaults($data->toArray());
	}
	public function actionUsertypeDelete($id){
		$values['is_trash'] = 1;
        $post = $this->database->table('master_user_type')->get($id);
		if($post->update($values)){
			$this->flashMessage('User type was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('usertype');	
	}
	public function actionUsertypeAction($id){
        $post = $this->database->table('master_user_type')->get($id);
        if(isset($post['is_enable']) && $post['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($post->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('User type was enabled', 'success');
			}else{
				$this->flashMessage('User type was disabled', 'success');
			}
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('usertype');		
	}			
}