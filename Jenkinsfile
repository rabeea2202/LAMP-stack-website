pipeline {
  agent any

  environment {
    COMPOSE_PROJECT_NAME = 'jenkinslamp'
  }

  stages {
    stage('Build and Deploy') {
      steps {
        sh 'docker-compose -p jenkinslamp -f docker-compose.yml up -d --build'
      }
    }

    stage('Run Tests') {
      steps {
        sh 'rm -rf lamp-website-tests'
        sh 'git clone https://github.com/rabeea2202/lamp-website-tests.git'
        sh 'chmod +x lamp-website-tests/test_main.sh'
        sh './lamp-website-tests/test_main.sh'
      }
    }
  }

  post {
    success {
      script {
        def committer = sh(script: "git log -1 --pretty=format:'%ae'", returnStdout: true).trim()

        // Fallback if email is GitHub noreply
        if (committer.contains("noreply.github.com")) {
          committer = "your-team-email@example.com"
        }

        echo "Sending success email to: ${committer}"

        emailext (
          subject: "Build Successful: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
          body: """Good news!

Your recent push passed all tests.

🔗 View Build: ${env.BUILD_URL}
""",
          to: "${committer}"
        )
      }
    }

    failure {
      script {
        def committer = sh(script: "git log -1 --pretty=format:'%ae'", returnStdout: true).trim()

        // Fallback if email is GitHub noreply
        if (committer.contains("noreply.github.com")) {
          committer = "your-team-email@example.com"
        }

        echo "Sending failure email to: ${committer}"

        emailext (
          subject: "Build Failed: ${env.JOB_NAME} #${env.BUILD_NUMBER}",
          body: """Oops! Your recent push failed the tests.

Please review the logs and fix the issues.

🔗 View Build: ${env.BUILD_URL}
""",
          to: "${committer}"
        )
      }
    }
  }
}
