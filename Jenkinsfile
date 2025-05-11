pipeline {
    agent any

    environment {
        COMPOSE_PROJECT_NAME = 'jenkinslamp'
    }

    stages {
        stage('Clone') {
            steps {
                git 'https://github.com/rabeea2202/LAMP-stack-website.git'
            }
        }

        stage('Build and Deploy') {
            steps {
                script {
                    sh 'docker-compose -p jenkinslamp -f docker-compose.yml up -d --build'
                }
            }
        }
    }
}
