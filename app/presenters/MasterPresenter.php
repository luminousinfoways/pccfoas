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
		$sms = array('N'=>'No','Y'=>'Yes');
		$sequreConnection = array(''=>'No','ssl'=>'SSL','tls'=>'TLS');
	    $form = new UI\Form;
	    $form->addHidden('created')->setValue(date('Y-m-d'));
	    $form->addHidden('modified')->setValue(date('Y-m-d'));
	    $form->addHidden('modified_by')->setValue(date(1));
	    $form->addText('from_mail', 'From Mail Id :')->setRequired("Please enter from mail id")->addRule(Form::EMAIL, 'Please enter valid mail address');;
	    $form->addText('sender_name', 'Sender Name :')->setRequired("Please enter from name");
	    $form->addText('smtp_server', 'SMTP Server :')->setRequired("Please enter SMTP server address");
	    $form->addPassword('password', 'SMTP Password:')->setRequired("please enter SMTP password");
	    $form->addSelect('secure_connection', 'Sequre Connection:',$sequreConnection);
	    $form->addText('smtp_port', 'Smtp Port:')->setRequired("please enter SMTP port")->setType('number');
	    $form->addSelect('is_ssl', 'is SSL? :',$sms)->setRequired();
	    $form->addSelect('is_html', 'Is Html?:',$htmlList)->setRequired();
	    $form->addSelect('sms_enable', 'SMS Enable?:',$sms)->setRequired();
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
	 * 	 	 */

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

	/*
     *Code start for master mail setting
	*/ 
	public function renderMenu(){
		$this->template->menu = $this->database->table('master_menus')->where('is_trash', 0)->order('id DESC');		
		$this->template->cnt = 0;
	}		
	public function createComponentMenu(){
	    $form = new UI\Form;
	    $this->database->table('master_menus')->order('name DESC');
	    $menuList =array(0=>"No Parent");
	    $menuList += $wings = $this->database->table('master_menus')->fetchPairs('id', 'name');

	    $form->addHidden('created')->setValue(date('Y-m-d H:i:s'));
	    $form->addHidden('modified')->setValue(date('Y-m-d H:i:s'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);
	    $form->addText('name', 'Menu Name :')->setRequired("Please enter menu name");
	    $form->addText('menu_url', 'Menu URL :')->setRequired("Please enter menu name");
	    $form->addTextarea('description', 'Menu Description :')->setRequired("Please enter menu description");
	    $form->addSelect('parent_id', 'Parent Menu Name :',$menuList);
	    
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'menuSucceeded');
	    return $form;
	}	
	public function menuSucceeded($form, $values){
	    $menu_id = $this->getParameter('menu_id');
	    if($menu_id) {
	    	unset($values['created']);
	        $menu = $this->database->table('master_menus')->get($menu_id);
	        $menu->update($values);
	        $this->flashMessage('menu has updated', 'success');
	    }else{
	        $menu = $this->database->table('master_menus')->insert($values);
	        $this->flashMessage('menu has saved', 'success');
	    }
	    $this->redirect('menu');		
	}
	public function actionMenuEdit($menu_id){
	    $data = $this->database->table('master_menus')->get($menu_id);
	    if (!$data) {
	        $this->error('Post not found');
	    }	    
	    $this['menu']->setDefaults($data->toArray());
	}
	public function actionMenuDelete($id){	
		$values['is_trash'] = 1;
        $menu = $this->database->table('master_menus')->get($id);
		if($menu->update($values)){
			$this->flashMessage('Menu was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('menu');		
	}

	public function actionMenuAction($id){
        $menu = $this->database->table('master_menus')->get($id);
        if(isset($menu['is_enable']) && $menu['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($menu->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('Menu was enabled', 'success');
			}else{
				$this->flashMessage('Menu was disabled', 'danger');
			}
		}else{
			$this->flashMessage('Invalid request for enable/disable', 'success');
		}
		$this->redirect('menu');		
	}

	/*
     *Code start for document category
	*/ 
	public function renderDocumentCategory(){
		$this->template->documentCategory = $this->database->table('master_document_categories')->where('is_trash', 0)->order('id DESC');		
		$this->template->cnt = 0;
	}		
	public function createComponentDocumentCategory(){
	    $form = new UI\Form;	    

	    $form->addHidden('created')->setValue(date('Y-m-d H:i:s'));
	    $form->addHidden('modified')->setValue(date('Y-m-d H:i:s'));
	    $form->addHidden('created_by')->setValue(1);
	    $form->addHidden('modified_by')->setValue(1);
	    $form->addText('name', 'Category Name :')->setRequired("Please enter category name");
	    
	    $form->addSubmit('save', 'Save');
	    $form->onSuccess[] = array($this, 'documentCategorySucceeded');
	    return $form;
	}	
	public function documentCategorySucceeded($form, $values){
	    $doc_cat_id = $this->getParameter('doc_cat_id');
	    if($doc_cat_id) {
	    	unset($values['created']);
	        $docCat = $this->database->table('master_document_categories')->get($doc_cat_id);
	        $docCat->update($values);
	        $this->flashMessage('Document category has updated', 'success');
	    }else{
	        $docCat = $this->database->table('master_document_categories')->insert($values);
	        $this->flashMessage('Document category has saved', 'success');
	    }
	    $this->redirect('documentCategory');		
	}
	public function actionDocumentCategoryEdit($doc_cat_id){
	    $data = $this->database->table('master_document_categories')->get($doc_cat_id);
	    if (!$data) {
	        $this->error('Post not found');
	    }	    
	    $this['documentCategory']->setDefaults($data->toArray());
	}
	public function actionDocumentCategoryDelete($id){	
		$values['is_trash'] = 1;
        $menu = $this->database->table('master_document_categories')->get($id);
		if($menu->update($values)){
			$this->flashMessage('Menu was deleted', 'success');
		}else{
			$this->flashMessage('Invalid request for delete', 'success');
		}
		$this->redirect('documentCategory');		
	}

	public function actionDocumentCategoryAction($id){
        $documentCat = $this->database->table('master_document_categories')->get($id);
        if(isset($documentCat['is_enable']) && $documentCat['is_enable'] == 0){
        	$values['is_enable'] = 1;
        }else{
        	$values['is_enable'] = 0;
        }
		if($documentCat->update($values)){
			if($values['is_enable'] == 1){
				$this->flashMessage('Menu was enabled', 'success');
			}else{
				$this->flashMessage('Menu was disabled', 'danger');
			}
		}else{
			$this->flashMessage('Invalid request for enable/disable', 'success');
		}
		$this->redirect('documentCategory');		
	}
}

