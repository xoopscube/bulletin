<?php

eval( ' function xoops_module_uninstall_' . $mydirname . '( $module ) { return bulletin_onuninstall_base( $module , \'' . $mydirname . '\' ) ; } ' );

if ( ! function_exists( 'bulletin_onuninstall_base' ) ) {

    function bulletin_onuninstall_base( $module , $mydirname )
    {
        // transactions on module uninstall

        global $ret ;

        // for Cube 2.1
        if ( defined( 'XOOPS_CUBE_LEGACY' ) ) {
            $isCube = true ;
            $root = &XCube_Root::getSingleton();
            $root->mDelegateManager->add( 'Legacy.Admin.Event.ModuleUninstall.' . ucfirst( $mydirname ) . '.Success', 'bulletin_message_append_onuninstall' );
            $ret = [];
        } else {
            $isCube = false ;
            if ( ! is_array( $ret ) ) {
                $ret = [];
            }
        }

        $db = &XoopsDatabaseFactory::getDatabaseConnection();
        $mid = $module->getVar('mid') ;

        // TABLES (loading mysql.sql)
        $sql_file_path = __DIR__ . '/sql/mysql.sql';
        $prefix_mod    = $db->prefix() . '_' . $mydirname;
        if ( file_exists( $sql_file_path ) ) {
            $ret[]     = 'SQL file found at <b>' . htmlspecialchars( $sql_file_path ) . '</b>.<br  /> Deleting tables...<br>';
            $sql_lines = file( $sql_file_path ) ;
            foreach ( $sql_lines as $sql_line ) {
                if ( preg_match( '/^CREATE TABLE \`?([a-zA-Z0-9_-]+)\`? /i', $sql_line, $regs ) ) {
                    $sql = 'DROP TABLE ' . $prefix_mod . '_' . $regs[1];
                    if ( ! $db->query( $sql ) ) {
                        $ret[] = '<span style="color:#ff0000;">ERROR: Could not drop table <b>' . htmlspecialchars( $prefix_mod . '_' . $regs[1] ) . '<b>.</span><br>';
                    } else {
                        $ret[] = 'Table <b>' . htmlspecialchars( $prefix_mod . '_' . $regs[1] ) . '</b> dropped.<br>';
                    }
                }
            }
        }

        return true;
    }

    function bulletin_message_append_onuninstall( &$module_obj , &$log ) {
        if( is_array( @$GLOBALS['ret'] ) ) {
            foreach( $GLOBALS['ret'] as $message ) {
                $log->add( strip_tags( $message ) ) ;
            }
        }

        // use mLog->addWarning() or mLog->addError() if necessary
    }
}
