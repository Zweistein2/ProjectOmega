node {
    stage('checkout') {
         checkout([$class: 'GitSCM', branches: [[name: '**']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[url: 'https://github.com/Zweistein2/ProjectOmega.git']]])
         echo 'Building..'
   }

    stage('Deploy') {
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