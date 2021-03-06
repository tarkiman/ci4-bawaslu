import static com.kms.katalon.core.checkpoint.CheckpointFactory.findCheckpoint
import static com.kms.katalon.core.testcase.TestCaseFactory.findTestCase
import static com.kms.katalon.core.testdata.TestDataFactory.findTestData
import static com.kms.katalon.core.testobject.ObjectRepository.findTestObject
import static com.kms.katalon.core.testobject.ObjectRepository.findWindowsObject
import com.kms.katalon.core.checkpoint.Checkpoint as Checkpoint
import com.kms.katalon.core.cucumber.keyword.CucumberBuiltinKeywords as CucumberKW
import com.kms.katalon.core.mobile.keyword.MobileBuiltInKeywords as Mobile
import com.kms.katalon.core.model.FailureHandling as FailureHandling
import com.kms.katalon.core.testcase.TestCase as TestCase
import com.kms.katalon.core.testdata.TestData as TestData
import com.kms.katalon.core.testobject.TestObject as TestObject
import com.kms.katalon.core.webservice.keyword.WSBuiltInKeywords as WS
import com.kms.katalon.core.webui.keyword.WebUiBuiltInKeywords as WebUI
import com.kms.katalon.core.windows.keyword.WindowsBuiltinKeywords as Windows
import internal.GlobalVariable as GlobalVariable

WebUI.openBrowser('http://localhost:8080/login')

WebUI.setText(findTestObject('Login/FieldUsername'), 'admin')

WebUI.setText(findTestObject('Login/FieldPassword'), 'admin')

WebUI.click(findTestObject('Login/ButtonLogin'))

WebUI.click(findTestObject('Menu/MenuEselon'))

WebUI.click(findTestObject('Auditor/ButtonCreateNew'))

WebUI.setText(findTestObject('Eselon/From Create/FieldNama'), 'Nana')

WebUI.setText(findTestObject('Eselon/From Create/Level Eselon'), '4')

WebUI.setText(findTestObject('Eselon/From Create/ID Parent'), '1010')

WebUI.click(findTestObject('Eselon/From Create/ButtonSubmit'))

