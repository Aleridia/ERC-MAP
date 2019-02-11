<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190208125020 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE EXTENSION IF NOT EXISTS postgis WITH SCHEMA public;');
        $this->addSql('CREATE SEQUENCE grande_region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE corpus_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE localisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE titre_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE auteur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE q_topographie_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_materiau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE sous_region_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE langue_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE biblio_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE source_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE categorie_support_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE datation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE entite_politique_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE type_support_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE q_fonction_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE materiau_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE chercheur_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE grande_region (id SMALLINT NOT NULL, geom geometry(MULTIPOLYGON, 4326) DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE corpus (id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, nom_complet TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE localisation (id INT NOT NULL, entite_politique INT DEFAULT NULL, grande_region_id SMALLINT DEFAULT NULL, sous_region_id SMALLINT DEFAULT NULL, pleiades_ville INT DEFAULT NULL, nom_ville VARCHAR(255) DEFAULT NULL, latitude DOUBLE PRECISION DEFAULT NULL, longitude DOUBLE PRECISION DEFAULT NULL, pleiades_site INT DEFAULT NULL, nom_site VARCHAR(255) DEFAULT NULL, reel BOOLEAN DEFAULT NULL, geom geometry(POINT, 4326) DEFAULT NULL, commentaire_fr VARCHAR(255) DEFAULT NULL, commentaire_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BFD3CE8FDEC11ACA ON localisation (entite_politique)');
        $this->addSql('CREATE INDEX IDX_BFD3CE8F5FF94818 ON localisation (grande_region_id)');
        $this->addSql('CREATE INDEX IDX_BFD3CE8F832FEA1A ON localisation (sous_region_id)');
        $this->addSql('CREATE TABLE localisation_q_topographie (id_localisation INT NOT NULL, id_q_topographie SMALLINT NOT NULL, PRIMARY KEY(id_localisation, id_q_topographie))');
        $this->addSql('CREATE INDEX IDX_C3D418BE9C12BBFD ON localisation_q_topographie (id_localisation)');
        $this->addSql('CREATE INDEX IDX_C3D418BE71B07B4 ON localisation_q_topographie (id_q_topographie)');
        $this->addSql('CREATE TABLE localisation_q_fonction (id_localisation INT NOT NULL, id_q_fonction SMALLINT NOT NULL, PRIMARY KEY(id_localisation, id_q_fonction))');
        $this->addSql('CREATE INDEX IDX_F8B0B4679C12BBFD ON localisation_q_fonction (id_localisation)');
        $this->addSql('CREATE INDEX IDX_F8B0B4679E428274 ON localisation_q_fonction (id_q_fonction)');
        $this->addSql('CREATE TABLE titre (id INT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE titre_auteur (id_titre INT NOT NULL, id_auteur INT NOT NULL, PRIMARY KEY(id_titre, id_auteur))');
        $this->addSql('CREATE INDEX IDX_AFF93D8A11F20684 ON titre_auteur (id_titre)');
        $this->addSql('CREATE INDEX IDX_AFF93D8A236D04AD ON titre_auteur (id_auteur)');
        $this->addSql('CREATE TABLE categorie_source (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_source (id SMALLINT NOT NULL, categorie_source_id SMALLINT DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_7C5D144B38631366 ON type_source (categorie_source_id)');
        $this->addSql('CREATE TABLE auteur (id INT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE q_topographie (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE categorie_materiau (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE sous_region (id SMALLINT NOT NULL, grande_region_id SMALLINT DEFAULT NULL, geom geometry(POINT, 4326) DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DF7D03815FF94818 ON sous_region (grande_region_id)');
        $this->addSql('CREATE TABLE source_biblio (id_source INT NOT NULL, id_biblio INT NOT NULL, edition_principale BOOLEAN DEFAULT NULL, reference_source VARCHAR(255) DEFAULT NULL, commentaire_fr VARCHAR(255) DEFAULT NULL, commentaire_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id_source, id_biblio))');
        $this->addSql('CREATE INDEX IDX_6FF39EC379BDCA9E ON source_biblio (id_source)');
        $this->addSql('CREATE INDEX IDX_6FF39EC3FF3B0EC8 ON source_biblio (id_biblio)');
        $this->addSql('CREATE TABLE langue (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE biblio (id INT NOT NULL, corpus_id INT DEFAULT NULL, titre_abrege VARCHAR(255) DEFAULT NULL, titre_complet TEXT DEFAULT NULL, annee SMALLINT DEFAULT NULL, auteur_biblio VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D90CBB252B41ABF4 ON biblio (corpus_id)');
        $this->addSql('CREATE TABLE source (id INT NOT NULL, titre_principal_id INT DEFAULT NULL, type_support_id SMALLINT DEFAULT NULL, categorie_support_id SMALLINT DEFAULT NULL, materiau_id SMALLINT DEFAULT NULL, categorie_materiau_id SMALLINT DEFAULT NULL, type_source_id SMALLINT DEFAULT NULL, categorie_source_id SMALLINT DEFAULT NULL, datation_id INT DEFAULT NULL, user_creation_id INT NOT NULL, user_edition_id INT NOT NULL, version INT NOT NULL, citation BOOLEAN DEFAULT NULL, iconographie BOOLEAN DEFAULT NULL, url_texte TEXT DEFAULT NULL, url_image TEXT DEFAULT NULL, in_situ BOOLEAN DEFAULT NULL, fiabilite_localisation SMALLINT DEFAULT NULL, fiabilite_datation SMALLINT DEFAULT NULL, date_creation TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, date_modification TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, traduire_fr BOOLEAN DEFAULT NULL, traduire_en BOOLEAN DEFAULT NULL, commentaire_fr VARCHAR(255) DEFAULT NULL, commentaire_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F8A7F7381C7EF2 ON source (titre_principal_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F731E166220 ON source (type_support_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F739DDC7EA9 ON source (categorie_support_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F73CE19B47A ON source (materiau_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F7311E79273 ON source (categorie_materiau_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F7321FA5D71 ON source (type_source_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F7338631366 ON source (categorie_source_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5F8A7F736AE6DFC0 ON source (datation_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F739DE46F0F ON source (user_creation_id)');
        $this->addSql('CREATE INDEX IDX_5F8A7F73D34FDCB2 ON source (user_edition_id)');
        $this->addSql('CREATE TABLE source_titre_cite (id_source INT NOT NULL, id_titre INT NOT NULL, PRIMARY KEY(id_source, id_titre))');
        $this->addSql('CREATE INDEX IDX_39D512B379BDCA9E ON source_titre_cite (id_source)');
        $this->addSql('CREATE INDEX IDX_39D512B311F20684 ON source_titre_cite (id_titre)');
        $this->addSql('CREATE TABLE source_auteur (id_source INT NOT NULL, id_auteur INT NOT NULL, PRIMARY KEY(id_source, id_auteur))');
        $this->addSql('CREATE INDEX IDX_B3A594A679BDCA9E ON source_auteur (id_source)');
        $this->addSql('CREATE INDEX IDX_B3A594A6236D04AD ON source_auteur (id_auteur)');
        $this->addSql('CREATE TABLE source_langue (id_source INT NOT NULL, id_langue SMALLINT NOT NULL, PRIMARY KEY(id_source, id_langue))');
        $this->addSql('CREATE INDEX IDX_25A8506879BDCA9E ON source_langue (id_source)');
        $this->addSql('CREATE INDEX IDX_25A85068B560C063 ON source_langue (id_langue)');
        $this->addSql('CREATE TABLE categorie_support (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE datation (id INT NOT NULL, post_quem SMALLINT DEFAULT NULL, ante_quem SMALLINT DEFAULT NULL, post_quem_citation SMALLINT DEFAULT NULL, ante_quem_citation SMALLINT DEFAULT NULL, dateAncienne TEXT DEFAULT NULL, commentaire_fr VARCHAR(255) DEFAULT NULL, commentaire_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE entite_politique (id INT NOT NULL, numero_iacp SMALLINT DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE type_support (id SMALLINT NOT NULL, categorie_support_id SMALLINT DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A82584509DDC7EA9 ON type_support (categorie_support_id)');
        $this->addSql('CREATE TABLE q_fonction (id SMALLINT NOT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE materiau (id SMALLINT NOT NULL, categorie_materiau_id SMALLINT DEFAULT NULL, nom_fr VARCHAR(255) DEFAULT NULL, nom_en VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_18D5DD5511E79273 ON materiau (categorie_materiau_id)');
        $this->addSql('CREATE TABLE chercheur (id INT NOT NULL, prenom_nom VARCHAR(255) NOT NULL, username VARCHAR(150) NOT NULL, institution VARCHAR(250) DEFAULT NULL, mail VARCHAR(250) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, preference_langue VARCHAR(2) DEFAULT NULL, date_ajout DATE DEFAULT NULL, role VARCHAR(50) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE localisation ADD CONSTRAINT FK_BFD3CE8FDEC11ACA FOREIGN KEY (entite_politique) REFERENCES entite_politique (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation ADD CONSTRAINT FK_BFD3CE8F5FF94818 FOREIGN KEY (grande_region_id) REFERENCES grande_region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation ADD CONSTRAINT FK_BFD3CE8F832FEA1A FOREIGN KEY (sous_region_id) REFERENCES sous_region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation_q_topographie ADD CONSTRAINT FK_C3D418BE9C12BBFD FOREIGN KEY (id_localisation) REFERENCES localisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation_q_topographie ADD CONSTRAINT FK_C3D418BE71B07B4 FOREIGN KEY (id_q_topographie) REFERENCES q_topographie (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation_q_fonction ADD CONSTRAINT FK_F8B0B4679C12BBFD FOREIGN KEY (id_localisation) REFERENCES localisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE localisation_q_fonction ADD CONSTRAINT FK_F8B0B4679E428274 FOREIGN KEY (id_q_fonction) REFERENCES q_fonction (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE titre_auteur ADD CONSTRAINT FK_AFF93D8A11F20684 FOREIGN KEY (id_titre) REFERENCES titre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE titre_auteur ADD CONSTRAINT FK_AFF93D8A236D04AD FOREIGN KEY (id_auteur) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_source ADD CONSTRAINT FK_7C5D144B38631366 FOREIGN KEY (categorie_source_id) REFERENCES categorie_source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sous_region ADD CONSTRAINT FK_DF7D03815FF94818 FOREIGN KEY (grande_region_id) REFERENCES grande_region (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_biblio ADD CONSTRAINT FK_6FF39EC379BDCA9E FOREIGN KEY (id_source) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_biblio ADD CONSTRAINT FK_6FF39EC3FF3B0EC8 FOREIGN KEY (id_biblio) REFERENCES biblio (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE biblio ADD CONSTRAINT FK_D90CBB252B41ABF4 FOREIGN KEY (corpus_id) REFERENCES corpus (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7381C7EF2 FOREIGN KEY (titre_principal_id) REFERENCES titre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F731E166220 FOREIGN KEY (type_support_id) REFERENCES type_support (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F739DDC7EA9 FOREIGN KEY (categorie_support_id) REFERENCES categorie_support (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73CE19B47A FOREIGN KEY (materiau_id) REFERENCES materiau (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7311E79273 FOREIGN KEY (categorie_materiau_id) REFERENCES categorie_materiau (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7321FA5D71 FOREIGN KEY (type_source_id) REFERENCES type_source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F7338631366 FOREIGN KEY (categorie_source_id) REFERENCES categorie_source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F736AE6DFC0 FOREIGN KEY (datation_id) REFERENCES datation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F739DE46F0F FOREIGN KEY (user_creation_id) REFERENCES chercheur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source ADD CONSTRAINT FK_5F8A7F73D34FDCB2 FOREIGN KEY (user_edition_id) REFERENCES chercheur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_titre_cite ADD CONSTRAINT FK_39D512B379BDCA9E FOREIGN KEY (id_source) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_titre_cite ADD CONSTRAINT FK_39D512B311F20684 FOREIGN KEY (id_titre) REFERENCES titre (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_auteur ADD CONSTRAINT FK_B3A594A679BDCA9E FOREIGN KEY (id_source) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_auteur ADD CONSTRAINT FK_B3A594A6236D04AD FOREIGN KEY (id_auteur) REFERENCES auteur (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_langue ADD CONSTRAINT FK_25A8506879BDCA9E FOREIGN KEY (id_source) REFERENCES source (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE source_langue ADD CONSTRAINT FK_25A85068B560C063 FOREIGN KEY (id_langue) REFERENCES langue (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE type_support ADD CONSTRAINT FK_A82584509DDC7EA9 FOREIGN KEY (categorie_support_id) REFERENCES categorie_support (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE materiau ADD CONSTRAINT FK_18D5DD5511E79273 FOREIGN KEY (categorie_materiau_id) REFERENCES categorie_materiau (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE localisation DROP CONSTRAINT FK_BFD3CE8F5FF94818');
        $this->addSql('ALTER TABLE sous_region DROP CONSTRAINT FK_DF7D03815FF94818');
        $this->addSql('ALTER TABLE biblio DROP CONSTRAINT FK_D90CBB252B41ABF4');
        $this->addSql('ALTER TABLE localisation_q_topographie DROP CONSTRAINT FK_C3D418BE9C12BBFD');
        $this->addSql('ALTER TABLE localisation_q_fonction DROP CONSTRAINT FK_F8B0B4679C12BBFD');
        $this->addSql('ALTER TABLE titre_auteur DROP CONSTRAINT FK_AFF93D8A11F20684');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F7381C7EF2');
        $this->addSql('ALTER TABLE source_titre_cite DROP CONSTRAINT FK_39D512B311F20684');
        $this->addSql('ALTER TABLE type_source DROP CONSTRAINT FK_7C5D144B38631366');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F7338631366');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F7321FA5D71');
        $this->addSql('ALTER TABLE titre_auteur DROP CONSTRAINT FK_AFF93D8A236D04AD');
        $this->addSql('ALTER TABLE source_auteur DROP CONSTRAINT FK_B3A594A6236D04AD');
        $this->addSql('ALTER TABLE localisation_q_topographie DROP CONSTRAINT FK_C3D418BE71B07B4');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F7311E79273');
        $this->addSql('ALTER TABLE materiau DROP CONSTRAINT FK_18D5DD5511E79273');
        $this->addSql('ALTER TABLE localisation DROP CONSTRAINT FK_BFD3CE8F832FEA1A');
        $this->addSql('ALTER TABLE source_langue DROP CONSTRAINT FK_25A85068B560C063');
        $this->addSql('ALTER TABLE source_biblio DROP CONSTRAINT FK_6FF39EC3FF3B0EC8');
        $this->addSql('ALTER TABLE source_biblio DROP CONSTRAINT FK_6FF39EC379BDCA9E');
        $this->addSql('ALTER TABLE source_titre_cite DROP CONSTRAINT FK_39D512B379BDCA9E');
        $this->addSql('ALTER TABLE source_auteur DROP CONSTRAINT FK_B3A594A679BDCA9E');
        $this->addSql('ALTER TABLE source_langue DROP CONSTRAINT FK_25A8506879BDCA9E');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F739DDC7EA9');
        $this->addSql('ALTER TABLE type_support DROP CONSTRAINT FK_A82584509DDC7EA9');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F736AE6DFC0');
        $this->addSql('ALTER TABLE localisation DROP CONSTRAINT FK_BFD3CE8FDEC11ACA');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F731E166220');
        $this->addSql('ALTER TABLE localisation_q_fonction DROP CONSTRAINT FK_F8B0B4679E428274');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F73CE19B47A');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F739DE46F0F');
        $this->addSql('ALTER TABLE source DROP CONSTRAINT FK_5F8A7F73D34FDCB2');
        $this->addSql('DROP SEQUENCE grande_region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE corpus_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE localisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE titre_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE auteur_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE q_topographie_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_materiau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE sous_region_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE langue_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE biblio_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE source_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE categorie_support_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE datation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE entite_politique_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE type_support_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE q_fonction_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE materiau_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE chercheur_id_seq CASCADE');
        $this->addSql('DROP TABLE grande_region');
        $this->addSql('DROP TABLE corpus');
        $this->addSql('DROP TABLE localisation');
        $this->addSql('DROP TABLE localisation_q_topographie');
        $this->addSql('DROP TABLE localisation_q_fonction');
        $this->addSql('DROP TABLE titre');
        $this->addSql('DROP TABLE titre_auteur');
        $this->addSql('DROP TABLE categorie_source');
        $this->addSql('DROP TABLE type_source');
        $this->addSql('DROP TABLE auteur');
        $this->addSql('DROP TABLE q_topographie');
        $this->addSql('DROP TABLE categorie_materiau');
        $this->addSql('DROP TABLE sous_region');
        $this->addSql('DROP TABLE source_biblio');
        $this->addSql('DROP TABLE langue');
        $this->addSql('DROP TABLE biblio');
        $this->addSql('DROP TABLE source');
        $this->addSql('DROP TABLE source_titre_cite');
        $this->addSql('DROP TABLE source_auteur');
        $this->addSql('DROP TABLE source_langue');
        $this->addSql('DROP TABLE categorie_support');
        $this->addSql('DROP TABLE datation');
        $this->addSql('DROP TABLE entite_politique');
        $this->addSql('DROP TABLE type_support');
        $this->addSql('DROP TABLE q_fonction');
        $this->addSql('DROP TABLE materiau');
        $this->addSql('DROP TABLE chercheur');
    }
}
