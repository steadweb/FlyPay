<?php

namespace Steadweb\Flypay\Migrations;

use Doctrine\Common\DataFixtures\Loader;
use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Steadweb\Flypay\Fixtures\CardFixture;
use Steadweb\Flypay\Fixtures\ClientFixture;
use Steadweb\Flypay\Fixtures\LocationFixture;
use Steadweb\Flypay\Fixtures\PaymentFixture;
use Steadweb\Flypay\Fixtures\TableFixture;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170105174041 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
            [__DIR__ . '/../app/Entities/'],
            true,
            null,
            null,
            false
        );
        $em = \Doctrine\ORM\EntityManager::create($this->connection, $config);

        $loader = new Loader();
        $loader->addFixture(new ClientFixture());
        $loader->addFixture(new CardFixture());
        $loader->addFixture(new LocationFixture());
        $loader->addFixture(new TableFixture());
        $loader->addFixture(new PaymentFixture());

        $purger = new ORMPurger();
        $executor = new ORMExecutor($em, $purger);
        $executor->execute($loader->getFixtures());
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {}
}
