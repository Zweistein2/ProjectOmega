pipeline {
    agent any

    stages {
        stage('Build') {
            steps {
               checkout([$class: 'GitSCM', branches: [[name: '**']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[url: 'https://github.com/Zweistein2/ProjectOmega.git']]])
               echo 'Building..'
            }
        }
        stage('Deploy') {
            steps {
               sh """
                  #!/bin/bash
                  cp * /var/www/html/
               """
            }
        }
    }
}