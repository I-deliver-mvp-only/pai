<?php

class BooksController extends AppController
{
	var $name = 'Books';

	var $helpers = array('Html', 'Form');

	public function index()
	{
		$this->set('books', $this->Book->find('all'));
	}

	public function view($id)
	{
		$this->Book->id = $id;
		$this->set('book', $this->Book->read());
	}

	public function add()
	{
		if (!empty($this->data) && $this->Book->save($this->data)) {
			$this->Flash->set('Książka została dodana');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function delete($id)
	{
		if ($this->Book->delete($id)) {
			$this->Flash->set('Książka została usunięta');
			$this->redirect(array('action' => 'index'));
		}
	}

	public function edit($id = null)
	{
		$this->Book->id = $id;
		if (empty($this->data)) {
			$this->data = $this->Book->read();
		} else {
			if ($this->Book->save($this->data)) {
				$this->Flash->set('Książka została zmieniona');
				$this->redirect(array('action' => 'index'));
			}
		}
	}
}
