<?php

namespace Plugin\ImageAlbum\Form;



/**
 * This contains the Form to create the Note form
 *
 * @todo Check if same form can handle
 * @author x64
 *
 */
class Album {
	private $form;
	public function __construct() {
		$this->form = new \Ip\Form ();
		$this->createFields ();
	}
	public function createFields() {

		$this->form->addFieldset(new \Ip\Form\Fieldset("Create Album for Creche"));
        $caption=new \Ip\Form\Field\Text(array(
            'name'=>'name',
            'label'=>'Name'
        ));

        $caption->addValidator("Required");
        $this->form->addField($caption);

        //Set Caption
        $caption=new \Ip\Form\Field\Textarea(array(
           'name'=>'description',
            'label'=>'Decription'
        ));
        $caption->addValidator("Required");

        $this->form->addField($caption);


		//set the Admin Form
		$this->form->addField(new \Ip\Form\Field\Hidden(array(
				'name' => 'aa',
				'value' => 'ImageAlbum.create',
		)));
		//Create the create submit button
		$this->form->addField(new \Ip\Form\Field\Submit(
				array( 'name'=>'upload',
						'value' => 'Submit',
						'css'=>'btn btn-primary'
				)
		));
		$this->form->setEnvironment(\Ip\Form::ENVIRONMENT_ADMIN);
		$this->form->setMethod(\Ip\Form::METHOD_POST);
        $this->form->addAttribute("enctype","multipart/form-data");
        $this->form->setAjaxSubmit(false);
	}
	public function getForm(){
		return $this->form;
	}
}
?>