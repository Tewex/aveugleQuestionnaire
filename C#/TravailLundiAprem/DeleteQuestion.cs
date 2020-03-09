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
using Newtonsoft.Json;

namespace TravailLundiAprem
{
    public partial class DeleteQuestion : Form
    {
        public List<Question> questions;
        public DeleteQuestion()
        {
            InitializeComponent();
        }

        public Task<string> GetAllQuestions()
        {
            try
            {
                HttpWebRequest myRequest = (HttpWebRequest)WebRequest.Create("http://hibou.lab.ecinf.ch/blindtest/dataScript/getQuestions.php");
                myRequest.Method = "GET";
                myRequest.ContentType = "application/x-www-form-urlencoded";
                HttpWebResponse response = (HttpWebResponse)myRequest.GetResponse();
                StreamReader reader = new StreamReader(response.GetResponseStream());
                return reader.ReadToEndAsync();
            }
            catch (Exception e)
            {
                throw e;
            }
        }


        public void DisplayQuestions()
        {
            questions = JsonConvert.DeserializeObject<List<Question>>(GetAllQuestions().Result);
            foreach (var item in questions)
            {
                listBox1.Items.Add(item);
            }
        }
        private void button1_Click(object sender, EventArgs e)
        {
            
        }
    }
}
