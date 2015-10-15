<?php

namespace Mop\ArangoDbBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use triagens\ArangoDb\ConnectionOptions;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('mop_arangodb');
        
        $rootNode
            ->children()
                ->scalarNode('default_connection')->defaultNull()->end()
                ->arrayNode('connections')
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode(ConnectionOptions::OPTION_ENDPOINT)->end()
                            ->scalarNode(ConnectionOptions::OPTION_HOST)->end()
                            ->integerNode(ConnectionOptions::OPTION_PORT)->end()
                            ->integerNode(ConnectionOptions::OPTION_TIMEOUT)->end()
                            ->booleanNode(ConnectionOptions::OPTION_CREATE)->end()
                            ->scalarNode(ConnectionOptions::OPTION_REVISION)->end()
                            ->scalarNode(ConnectionOptions::OPTION_UPDATE_POLICY)->end()
                            ->booleanNode(ConnectionOptions::OPTION_UPDATE_KEEPNULL)->end()
                            ->scalarNode(ConnectionOptions::OPTION_REPLACE_POLICY)->end()
                            ->scalarNode(ConnectionOptions::OPTION_DELETE_POLICY)->end()
                            ->booleanNode(ConnectionOptions::OPTION_WAIT_SYNC)->end()
                            ->scalarNode(ConnectionOptions::OPTION_LIMIT)->end()
                            ->scalarNode(ConnectionOptions::OPTION_SKIP)->end()
                            ->scalarNode(ConnectionOptions::OPTION_BATCHSIZE)->end()
                            ->integerNode(ConnectionOptions::OPTION_JOURNAL_SIZE)->end()
                            ->booleanNode(ConnectionOptions::OPTION_IS_SYSTEM)->end()
                            ->booleanNode(ConnectionOptions::OPTION_IS_VOLATILE)->end()
                            ->scalarNode(ConnectionOptions::OPTION_AUTH_USER)->end()
                            ->scalarNode(ConnectionOptions::OPTION_AUTH_PASSWD)->end()
                            ->scalarNode(ConnectionOptions::OPTION_AUTH_TYPE)->end()
                            ->scalarNode(ConnectionOptions::OPTION_CONNECTION)->end()
                            ->booleanNode(ConnectionOptions::OPTION_RECONNECT)->end()
                            ->booleanNode(ConnectionOptions::OPTION_BATCH)->end()
                            ->booleanNode(ConnectionOptions::OPTION_BATCHPART)->end()
                            ->scalarNode(ConnectionOptions::OPTION_DATABASE)->end()
                            ->booleanNode(ConnectionOptions::OPTION_CHECK_UTF8_CONFORM)->end()
                            ->scalarNode(ConnectionOptions::OPTION_CUSTOM_QUEUE)->end()
                            ->integerNode(ConnectionOptions::OPTION_CUSTOM_QUEUE_COUNT)->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('fos')
                    ->children()
                        ->scalarNode('connection')->end()
                        ->scalarNode('collection')->end()
                    ->end()
                ->end()
            ->end();
        return $treeBuilder;
    }
}
