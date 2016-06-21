<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Connection extends Model
{
    protected $sshSession;

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function getSshSession() {
        if ($this->is_local) return null;

        if ($this->sshSession) return $this->sshSession;
        $sshConfig = new \Ssh\SshConfigFileConfiguration($this->ssh_config_path, $this->host);
        $authentication = $sshConfig->getAuthentication();

        $this->sshSession = new \Ssh\Session($sshConfig, $authentication);
        return $this->sshSession;
    }

    public function getDraftPathAttribute()
    {
        return '/' . join_path($this->project_path, $this->project->dotenv_path, $this->project->dotenv_draft);
    }

    public function getProdPathAttribute()
    {
        return '/' . join_path($this->project_path, $this->project->dotenv_path, $this->project->dotenv_name);
    }

    public function getBackupPathAttribute()
    {
        return '/' . join_path($this->project_path, $this->project->dotenv_path, $this->project->dotenv_backup);
    }

    public function getStagingPathAttribute()
    {
        return '/' . join_path($this->project_path, $this->project->dotenv_path, $this->project->dotenv_staging);
    }
}
