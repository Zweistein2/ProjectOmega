node {
    stage('checkout') {
         checkout([$class: 'GitSCM', branches: [[name: '**']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[url: 'https://github.com/Zweistein2/ProjectOmega.git']]])
         echo 'Building..'
   }

    stage('Deploy') {
        sed -i -e 's/192.168.20.1/localhost/g' php/database/*
         try{
             sh """
                rm -r /var/www/html/master/
            """
         }
         catch(Exception e){
             
         }
         sh """
            #!/bin/bash
            cp -r * /var/www/html/master/
         """
   }
}