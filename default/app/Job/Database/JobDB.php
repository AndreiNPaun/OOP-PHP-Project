<?php
namespace Job\Database;
Class JobDB {
    private $pdo;
	private $table;

	public function __construct($pdo, $table) {
		$this->pdo = $pdo;
		$this->table = $table;
	}
	
	public function homeList() {
		$date = new \DateTime();
        $dateFormat = $date->format('Y-m-d');

		$stmt = $this->pdo->prepare('SELECT * FROM job WHERE closingDate > :date ORDER BY closingDate LIMIT 10');
		$values = [
			'date' => $dateFormat
		];
		$stmt->execute($values);
		return $stmt->fetchAll();
	}

	public function test() {
		$applicants = $pdo->prepare('SELECT count(*) as count FROM applicants WHERE jobId = :jobId');
		$applicants->execute(['jobId' => $job['id']]);
		$applicantCount = $applicants->fetch();
	}
    
    public function findBy($field, $value) {

        $date = new \DateTime();
        $dateFormat = $date->format('Y-m-d');

        $stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE '. $field . ' = :value AND closingDate > :date');
		$values = [
			'value' => $value,
			'date' => $dateFormat
		];
		$stmt->execute($values);
		
		return $stmt->fetchAll();		
	}

	//USE OR DELETE
	public function categoryName($id) {
		$stmt = $this->pdo->prepare('INSERT INTO job (categoryName) VALUES (:category) WHERE categoryId = :categoryId');
		$values = [
			'categoryId' => $id
		];
		$stmt->execute();
	}

	//USE OR DELETE
	public function applicantCount($id) {
		$stmt = $this->pdo->prepare('SELECT count(*) as count FROM applicants WHERE jobId = :jobId');
		$stmt->execute(['jobId' => $id]);
		return $stmt->fetch();
	}
}