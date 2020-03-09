using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace TravailLundiAprem
{
    public partial class AddQuestion : Form
    {
        private string question;
        private string answer;
        public string Question { get => question; set => question = value; }
        public string Answer { get => answer; set => answer = value; }
        public AddQuestion()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            Question = textBox1.Text;
            Answer = textBox2.Text;
        }
    }
}
