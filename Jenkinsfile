pipeline {
  agent any
  environment {
    COMPOSE_PROJECT_NAME = 'jenkinslamp'
  }
  stages {
    stage('Clean up') {
      steps {
        script {
          // Stop containers and remove orphans, keep volumes
          sh 'docker-compose -p jenkinslamp -f docker-compose.yml down --remove-orphans || true'
        }
      }
    }
    stage('Build and Deploy') {
      steps {
        script {
          sh 'docker-compose -p jenkinslamp -f docker-compose.yml up -d --build'
        }
      }
    }
    stage('Initialize DB') {
      steps {
        script {
          // Wait a few seconds for DB to be ready, optional but recommended
          sh 'sleep 10'
          sh '''
            DB_CONTAINER=$(docker-compose -p jenkinslamp -f docker-compose.yml ps -q db)
            docker exec -i $DB_CONTAINER mysql -u user -puserpassword mydb < init_db.sql
          '''
        }
      }
    }
  }
}
