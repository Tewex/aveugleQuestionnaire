using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Net;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace TravailLundiAprem
{
    public partial class Form1 : Form
    {
        private static readonly Encoding encoding = Encoding.UTF8;
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            AddQuestion addQuestion = new AddQuestion();
            if (addQuestion.ShowDialog() == DialogResult.OK)
            {
                CreateQuestion(addQuestion.Question, addQuestion.Answer); 
            }
        }

        private void CreateQuestion(string question,string answer)
        {
            string postData = "question=" + Uri.EscapeDataString(question);
            postData += "&answer=" + Uri.EscapeDataString(answer);
            // hibou.lab.ecinf.ch/blindtest/
            HttpWebRequest request = (HttpWebRequest)WebRequest.Create("http://hibou.lab.ecinf.ch/blindtest/dataScript/createQuestion.php");
            byte[] byteArray = Encoding.UTF8.GetBytes(postData);
            string contentType = "application/x-www-form-urlencoded";

            request.Method = "POST";
            request.ContentType = contentType;
            request.ContentLength = byteArray.Length;


            // Get the request stream.  
            Stream dataStream = request.GetRequestStream();
            // Write the data to the request stream.  
            dataStream.Write(byteArray, 0, byteArray.Length);
            var reponse = request.GetResponse();
            // Close the Stream object.  
            dataStream.Close();

        }

        private void button3_Click(object sender, EventArgs e)
        {
            DeleteQuestion deleteQuestion = new DeleteQuestion();
            deleteQuestion.Show();
            deleteQuestion.DisplayQuestions();
        }
    }
}
