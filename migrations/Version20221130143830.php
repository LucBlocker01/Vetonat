<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221130143830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client ADD personne_id INT NOT NULL, DROP nom_pers, DROP pnom_pers, DROP ville_pers, DROP cppers, DROP tel_pers, DROP login_pers, DROP mdp_pers, DROP adr_pers');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_C7440455A21BD112 ON client (personne_id)');
        $this->addSql('ALTER TABLE veterinaire ADD personne_id INT NOT NULL, DROP nom_pers, DROP pnom_pers, DROP ville_pers, DROP cppers, DROP tel_pers, DROP login_pers, DROP mdp_pers, DROP adr_pers');
        $this->addSql('ALTER TABLE veterinaire ADD CONSTRAINT FK_E9D962B8A21BD112 FOREIGN KEY (personne_id) REFERENCES personne (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E9D962B8A21BD112 ON veterinaire (personne_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A21BD112');
        $this->addSql('DROP INDEX UNIQ_C7440455A21BD112 ON client');
        $this->addSql('ALTER TABLE client ADD nom_pers VARCHAR(255) NOT NULL, ADD pnom_pers VARCHAR(255) NOT NULL, ADD ville_pers VARCHAR(255) NOT NULL, ADD cppers VARCHAR(255) NOT NULL, ADD tel_pers VARCHAR(255) NOT NULL, ADD login_pers VARCHAR(255) NOT NULL, ADD mdp_pers VARCHAR(255) NOT NULL, ADD adr_pers VARCHAR(255) NOT NULL, DROP personne_id');
        $this->addSql('ALTER TABLE veterinaire DROP FOREIGN KEY FK_E9D962B8A21BD112');
        $this->addSql('DROP INDEX UNIQ_E9D962B8A21BD112 ON veterinaire');
        $this->addSql('ALTER TABLE veterinaire ADD nom_pers VARCHAR(255) NOT NULL, ADD pnom_pers VARCHAR(255) NOT NULL, ADD ville_pers VARCHAR(255) NOT NULL, ADD cppers VARCHAR(255) NOT NULL, ADD tel_pers VARCHAR(255) NOT NULL, ADD login_pers VARCHAR(255) NOT NULL, ADD mdp_pers VARCHAR(255) NOT NULL, ADD adr_pers VARCHAR(255) NOT NULL, DROP personne_id');
    }
}
