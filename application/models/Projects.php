<?php
/* 
 *  @license http://www.gnu.org/licenses/gpl-2.0.html
 */
/**
 * Description of Projects
 * @copyright  Copyright Aug 12, 2011 Daniel Sheppard
 * @author Daniel Sheppard Aug 12, 2011
 * gutbunny@gmail.com
 * 
 */
class Application_Model_Projects  {

    private function connectDB() {

        $application = new Zend_Application(
            APPLICATION_ENV,
            APPLICATION_PATH . '/configs/application.ini'
        );
        $bootstrap = $application->getBootstrap();
        $bootstrap->bootstrap('db');
        $this->db = $bootstrap->getResource('db');
    }

    public function indexAction()
    {
        // action body
    }

    public function loadBranch($branch_id, $users_id) {

        $this->connectDB();
        $branches_sql = "select p.gb_projects_name as project,
                                pb.gb_projects_branches_name as branch,
                                pb.gb_projects_branches_id as branch_id
                        from    gb_projects_branches pb,
                                gb_projects_to_users ptu,
                                gb_projects p
                        where   pb.gb_projects_branches_id = " . $branch_id . "
                        and     pb.gb_projects_id = p.gb_projects_id
                        and     ptu.gb_projects_id = p.gb_projects_id
                        and     ptu.gb_users_id = " . $users_id;
        $branch = $this->db->fetchRow($branches_sql);

        $tracks_sql = "select t.*, ttb.*, u.*
                        from gb_tracks t, gb_tracks_to_branches ttb, gb_users u
                        where t.gb_tracks_id = ttb.gb_tracks_id
                        and ttb.gb_projects_branches_id = " . $branch['branch_id'] .
                        " and t.gb_tracks_creator_users_id = u.gb_users_id";
        $tracks = $this->db->fetchAll($tracks_sql);
        $branch['tracks'] = $tracks;
        return $branch;
    }

    public function getProjectsBranches() {

        $this->connectDB();
        $branches_sql = "select * from gb_projects_branches";
        $branches = $this->db->fetchAll($branches_sql);
        return $branches;
    }

    public function saveTrack($data, $gb_projects_branches_id) {

        $this->connectDB();
        $this->db->insert('gb_tracks', $data);

        $tracks_id = $this->db->lastInsertId();
        $data = array('gb_projects_branches_id' => $gb_projects_branches_id, 'gb_tracks_id' => $tracks_id);
        $this->db->insert('gb_tracks_to_branches', $data);
        return true;
    }
}

