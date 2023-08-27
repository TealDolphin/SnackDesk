<?php

// CONSTRUCT

/*
	PurchaseTable:
	[itterableID, Parent, Student, $, date(time), hotLunch(bool)]
	
	// on negative student means money placed into the account
	
	
	MoneyTable
	[itterableID, Parent, current $]
	
	People Table
	[itterableID, student, parent]
	
	// assumed that most of the time there will be multiple students per parent, but that is easy to reverse lookup if needed.
	
*/

    // Connect to the mysql instance and make the database
    mydb = mysql.connector.connect(host="localhost",user="root",passwd=""); //TODO: password
    mycursor = mydb.cursor();
    mycursor.execute("CREATE DATABASE snacks");
    mydb.commit();
    
    
    $conn = new PDO("host=127.0.0.1");
    
    
    
    $dataBase= 'mysql:dbname=snacks;charset=utf8;host=127.0.0.1';
	$user= 'root';
	$password= ''; //TODO To be determined   DO NOT LEAVE BLANK
	try {
		$this->DB= new PDO( $dataBase, $user, $password );
		$this->DB->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch ( PDOException$e ) {
	echo ('Error establishing Connection');
	exit();
	}
    
    // Connect to the database instance and create all tables with proper variables and names

	mycursor.execute('CREATE TABLE purchases (ID int NOT NULL AUTO_INCREMENT, parent varchar(60), student bigint, pValue int, pTime datetime, hotLunch tinyint, PRIMARY KEY (ID))');
    mydb.commit();
    
	mycursor.execute('CREATE TABLE money (ID int NOT NULL AUTO_INCREMENT, parent varchar(60), currentMoney int, PRIMARY KEY (ID)');
	mydb.commit();
	
	mycursor.execute('CREATE TABLE people (ID int NOT NULL AUTO_INCREMENT, student bigint, parent varchar(60), PRIMARY KEY (ID)');
	mydb.commit();

    // build out database with backed up information.
    
    
    






?>