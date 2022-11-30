<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130133926 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, nom_pers VARCHAR(255) NOT NULL, pnom_pers VARCHAR(255) NOT NULL, ville_pers VARCHAR(255) NOT NULL, cppers VARCHAR(255) NOT NULL, tel_pers VARCHAR(255) NOT NULL, login_pers VARCHAR(255) NOT NULL, mdp_pers VARCHAR(255) NOT NULL, adr_pers VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clinique (id INT AUTO_INCREMENT NOT NULL, adr_clinique VARCHAR(255) DEFAULT NULL, cpclinique VARCHAR(5) DEFAULT NULL, ville_clinique VARCHAR(255) DEFAULT NULL, tel_clinique VARCHAR(10) DEFAULT NULL, nom_clinique VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE consultation (id INT AUTO_INCREMENT NOT NULL, animal_id INT DEFAULT NULL, traitement_id INT DEFAULT NULL, veterinaire_id INT DEFAULT NULL, consultation_desc VARCHAR(255) NOT NULL, date_consultation DATE NOT NULL, motif_consultation VARCHAR(255) NOT NULL, clinique TINYINT(1) NOT NULL, urgente TINYINT(1) NOT NULL, INDEX IDX_964685A68E962C16 (animal_id), INDEX IDX_964685A6DDA344B6 (traitement_id), INDEX IDX_964685A65C80924 (veterinaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE personne (id INT AUTO_INCREMENT NOT NULL, nom_pers VARCHAR(255) NOT NULL, pnom_pers VARCHAR(255) NOT NULL, ville_pers VARCHAR(255) NOT NULL, cppers VARCHAR(255) NOT NULL, tel_pers VARCHAR(255) NOT NULL, login_pers VARCHAR(255) NOT NULL, mdp_pers VARCHAR(255) NOT NULL, adr_pers VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE traitement (id INT AUTO_INCREMENT NOT NULL, desc_trait VARCHAR(255) DEFAULT NULL, medicament VARCHAR(50) DEFAULT NULL, alimentation VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE veterinaire (id INT AUTO_INCREMENT NOT NULL, clinique_id INT NOT NULL, nom_pers VARCHAR(255) NOT NULL, pnom_pers VARCHAR(255) NOT NULL, ville_pers VARCHAR(255) NOT NULL, cppers VARCHAR(255) NOT NULL, tel_pers VARCHAR(255) NOT NULL, login_pers VARCHAR(255) NOT NULL, mdp_pers VARCHAR(255) NOT NULL, adr_pers VARCHAR(255) NOT NULL, INDEX IDX_E9D962B8265183A3 (clinique_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A68E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A6DDA344B6 FOREIGN KEY (traitement_id) REFERENCES traitement (id)');
        $this->addSql('ALTER TABLE consultation ADD CONSTRAINT FK_964685A65C80924 FOREIGN KEY (veterinaire_id) REFERENCES veterinaire (id)');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8265183A3 FOREIGN KEY (clinique_id) REFERENCES clinique (id)');
        $this->addSql('ALTER TABLE animal ADD client_id INT NOT NULL, CHANGE nom_animal nom_animal VARCHAR(255) NOT NULL, CHANGE espece_animal espece_animal VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F19EB6921 ON animal (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F19EB6921');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A68E962C16');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A6DDA344B6');
        $this->addSql('ALTER TABLE consultation DROP FOREIGN KEY FK_964685A65C80924');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8265183A3');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE clinique');
        $this->addSql('DROP TABLE consultation');
        $this->addSql('DROP TABLE personne');
        $this->addSql('DROP TABLE traitement');
        $this->addSql('DROP TABLE veterinaire');
        $this->addSql('DROP INDEX IDX_6AAB231F19EB6921 ON animal');
        $this->addSql('ALTER TABLE animal DROP client_id, CHANGE nom_animal nom_animal VARCHAR(50) NOT NULL, CHANGE espece_animal espece_animal VARCHAR(50) NOT NULL');
    }
}
