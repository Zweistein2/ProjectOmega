node {
    stage('checkout') {
        echo "checkout"
         checkout([$class: 'GitSCM', branches: [[name: '*/master']], doGenerateSubmoduleConfigurations: false, extensions: [], submoduleCfg: [], userRemoteConfigs: [[url: 'https://github.com/Zweistein2/ProjectOmega.git']]])

   }

   stage('config')  {
        echo "config"
        sh """
            #!/bin/bash
            sed -i -e 's/192.168.20.1/localhost/g' php/database/config.php
            sed -i -e 's/local/server/g' php/database/config.php
        """
   }


    stage('Deploy') {
        echo "deploy"
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