using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TravailLundiAprem
{
    public class Question
    {
        private string question;
        private string answer;
        private int questionId;
        public string AQuestion { get => question; set => question = value; }
        public string Answer { get => answer; set => answer = value; }
        public int QuestionID { get => questionId; set => questionId = value; }

        public Question(int questionId, string question,string answer)
        {
            this.questionId = questionId;
            this.question = question;
            this.answer = answer;
        }

        public override string ToString()
        {
            return question + " - " + answer;
        }
    }
}
